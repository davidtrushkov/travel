<?php

namespace App\Http\Controllers;

use App\User;
use App\Points;
use App\Mailers\AppMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;

class AuthController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */


    /**
     * Get the Registration View.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRegister() {
        return view('auth.register');
    }


    /**
     * Validate and create the user in the Database.
     *
     * @param RegistrationRequest $request
     * @param AppMailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister(RegistrationRequest $request, AppMailer $mailer) {
        // Create the user in the Database.
        $user = User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'verified' => 0,
            'points'
        ]);

        // Also insert a user_id of the currently registered user in
        // the points table so a user can start out with 0 points, and
        // so we can award points in the points model.
        Points::create([
            'user_id' => $user->id,
            'points'  => 0
        ]);


        /**
         * send email conformation to user that just registered.
         * -- sendEmailConfirmationTo is in Mailers/AppMailer.php --
         */
        $mailer->sendEmailConfirmationTo($user);

        // Flash a info message saying you need to confirm your email.
        flash()->overlay('Info', 'Please confirm your email address in your inbox.');

        return redirect()->back();
    }


    /**
     * Get the user token, an make check id email is confirmed.
     * -- confirmEmail located in User.php Model.
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmEmail($token) {
        // Get the user with token, or fail.
        User::whereToken($token)->firstOrFail()->confirmEmail();

        // Flash a info message saying you need to confirm your email.
        flash()->success('Success', 'You are now confirmed. Please sign in.');

        return redirect('/');
    }


    /** ----------------------------------------------------------------------------------- */



    /**
     * Get the login view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin() {
        return view('auth.login');
    }


    /**
     * Login in the user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postLogin(Request $request) {

        // Validate email and password.
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required|'
        ]);

        // login in user if successful
        if ($this->signIn($request)) {
            flash()->success('Success', 'You have successfully signed in.');
            return redirect('/');
        }

        // Else, show error message, and redirect them back to login.php.
        flash()->customErrorOverlay('Error', 'Could not sign you in with those credentials');

        return redirect('login');

    }


    /**
     * Attempt to sign in the user.
     *
     * @param  Request $request
     * @return boolean
     */
    protected function signIn(Request $request) {
        return Auth::attempt($this->getCredentials($request), $request->has('remember'));
    }


    /**
     * Get the user credentials to login.
     *
     * @param Request $request
     * @return array
     */
    protected function getCredentials(Request $request) {
        return [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
            'verified' => true
        ];
    }


    /**
     * Logout user.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout() {
        Auth::logout();
        return redirect('/');
    }

}