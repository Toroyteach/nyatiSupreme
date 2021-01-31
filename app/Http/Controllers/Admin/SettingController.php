<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\BaseController;
use App\Models\Admin;
use Illuminate\Support\Str;

/**
 * Class SettingController
 * @package App\Http\Controllers\Admin
 */
class SettingController extends BaseController
{
    use UploadAble;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setPageTitle('Settings', 'Manage Settings');
        return view('admin.settings.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        //dd($request->payment_policy);
        if ($request->has('site_logo') && ($request->file('site_logo') instanceof UploadedFile)) {

            if (config('settings.site_logo') != null) {
                $this->deleteOne(config('settings.site_logo'));
            }
            $logo = $this->uploadOne($request->file('site_logo'), 'img');
            Setting::set('site_logo', $logo);

        } elseif ($request->has('site_favicon') && ($request->file('site_favicon') instanceof UploadedFile)) {

            if (config('settings.site_favicon') != null) {
                $this->deleteOne(config('settings.site_favicon'));
            }
            $favicon = $this->uploadOne($request->file('site_favicon'), 'img');
            Setting::set('site_favicon', $favicon);

        } else {

            $keys = $request->except('_token');
            //dd($keys);

            foreach ($keys as $key => $value)
            {
                Setting::set($key, $value);
            }
        }
        return $this->responseRedirectBack('Settings updated successfully.', 'success');
    }

    public function updateUser(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'phonenumber' => ['required', 'digits:10'],
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //dd($request->all());

        if ($request->has('profile_image')) {
            // Get image file
            $image = $request->file('profile_image');
            // Make a image name based on user name and current timestamp
            $name = Str::slug($request->input('last_name')).'_'.time();
            // Define folder path
            $folder = '/uploads/web/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            //$user->profile_image = $filePath;
        }

        $user = Admin::findOrFail(auth()->user()->id);
        //get filestoreage properties
        $request->profile_image = $filePath;
        //dd($filePath);
        $input = $request->all();
        $input['profile_image'] = $filePath;
        //dd($input);
        $user->fill($input)->save();
        return $this->responseRedirectBack('Profile updated successfully.', 'success');
    }
}
