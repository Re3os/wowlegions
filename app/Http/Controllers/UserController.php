<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{Category, Topic, Account, User, CodesShop, PaymentDetails, Characters};

use App\Services\Soap;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createNameAction(Request $request) {
        $userTeg = User::createNameID(\Auth::user()->email, $request->get('freedomTag'));
        return view('profiles.createNameDone', [
            'profileUser' => \Auth::user(),
            'userTeg' => $userTeg,
        ]);
    }

    public function createName() {
        return view('profiles.createName', [
            'profileUser' => \Auth::user(),
        ]);
    }

    public function showOrders() {
        return view('profiles.orser.showOrders', [
            'profileUser' => \Auth::user(),
            'history' => PaymentDetails::where('userid', \Auth::user()->id)->get(),
        ]);
    }

    public function claimCodeLevelAction(Request $request) {
        $infoKey = CodesShop::where('purchase_code', $request->get('key'))->get();
        if($infoKey[0]->code_activated == 1) {
            return redirect()->back()->with("error","Этот код не подходит. Проверьте, правилен ли он, и введите его заново. Если вы все равно видите это сообщение, то попробуйте, пожалуйста, попозже еще раз: вероятно, на сайте сейчас проводится техническое обслуживание.");
        } else {
            Characters::where('name', $request->get('character'))->update(['level' => '110']);
            CodesShop::where('purchase_code', $request->get('key'))->update(['purchased_for_account' => \Auth::user()->id, 'code_activated' => '1']);
            return redirect(route('claim-code'))->with("success","Уровень персонажа успешно повышен до 110.");
        }
    }

    public function claimCodeSendAction(Request $request) {
        $infoKey = CodesShop::where('purchase_code', $request->get('key'))->get();
        if($infoKey[0]->code_activated == 1) {
            return redirect()->back()->with("error","Этот код не подходит. Проверьте, правилен ли он, и введите его заново. Если вы все равно видите это сообщение, то попробуйте, пожалуйста, попозже еще раз: вероятно, на сайте сейчас проводится техническое обслуживание.");
        } else {
            Soap::AddItemToList($infoKey[0]->item_id, 1);
            if(Soap::SendItem($request->get('character'), $infoKey[0]->item_name)) {
                CodesShop::where('purchase_code', $request->get('key'))->update(['purchased_for_account' => \Auth::user()->id, 'code_activated' => '1']);
                return redirect(route('claim-code'))->with("success","Код был успешно использован, товар был отправлен вам на внутреигровую почту.");
            } else {
                return redirect()->back()->with("error","Ошибка отправки итема");
            }
        }
    }

    public function claimCodeAction(Request $request) {
        $infoKey = CodesShop::where('purchase_code', $request->get('key'))->get();
        if(isset($infoKey[0])) {
            if($infoKey[0]->type == 1) {
                $accountID = Account::userGameAccount();
                return view('profiles.code.selectCharacters', [
                    'profileUser' => \Auth::user(),
                    'userGamrAccount' => $accountID,
                    'userCharacters' => Account::userGameCharacters($accountID[0]->id),
                    'key' => $request->get('key'),
                ]);
            }elseif($infoKey[0]->type == 2) {
                if($infoKey[0]->code_activated == 1) {
                    return redirect()->back()->with("error","Этот код не подходит. Проверьте, правилен ли он, и введите его заново. Если вы все равно видите это сообщение, то попробуйте, пожалуйста, попозже еще раз: вероятно, в игре или на сайте сейчас проводится техническое обслуживание.");
                } else {
                    $user = \Auth::user();
                    $user->balance += $infoKey[0]->money;
                    $user->save();
                    CodesShop::where('purchase_code', $request->get('key'))->update(['purchased_for_account' => \Auth::user()->id, 'code_activated' => '1']);
                    return view('profiles.code.addMoney', [
                        'profileUser' => \Auth::user(),
                    ]);
                }
            }elseif($infoKey[0]->type == 3) {
                if($infoKey[0]->code_activated == 1) {
                    return redirect()->back()->with("error","Этот код не подходит. Проверьте, правилен ли он, и введите его заново. Если вы все равно видите это сообщение, то попробуйте, пожалуйста, попозже еще раз: вероятно, в игре или на сайте сейчас проводится техническое обслуживание.");
                } else {
                    $accountID = Account::userGameAccount();
                    return view('profiles.code.selectCharactersLevel', [
                        'profileUser' => \Auth::user(),
                        'userGamrAccount' => $accountID,
                        'userCharacters' => Account::userGameCharacters($accountID[0]->id),
                        'key' => $request->get('key'),
                    ]);
                }
            }
        } else {
            return redirect()->back()->with("error","Этот код не подходит. Проверьте, правилен ли он, и введите его заново. Если вы все равно видите это сообщение, то попробуйте, пожалуйста, попозже еще раз: вероятно, в игре или на сайте сейчас проводится техническое обслуживание.");
        }
    }

    public function tagNameChange() {
        return view('profiles.settings.tagNameChange', [
            'profileUser' => \Auth::user(),
            'userGamrAccount' => Account::userGameAccount(),
        ]);
    }

    public function tagNameChangeActoin(Request $request){
        if (!(\Hash::check($request->get('password'), \Auth::user()->password))) {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if($request->get('email') != $request->get('newEmailVerify')){
            return redirect()->back()->with("error","Mail does not match");
        }

        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        $user = \Auth::user();

        $account = Account::newEmail($user->email, $request->get('email'));

        //Change Email
        $user->email = $request->get('email');
        $user->save();

        return redirect()->back()->with("success","Email changed successfully!");

    }

    public function showProfile() {
        return view('profiles.showProfile', [
            'profileUser' => \Auth::user(),
            'userGamrAccount' => Account::userGameAccount(),
        ]);
    }

    public function dashboard() {
        return view('profiles.wow.dashboard', [
            'profileUser' => \Auth::user(),
            'userGamrAccount' => Account::userGameAccount(),
        ]);
    }

    public function showWallet() {
        return view('profiles.showWallet', [
            'profileUser' => \Auth::user(),
            'userGamrAccount' => Account::userGameAccount(),
        ]);
    }

    public function claimCode() {
        return view('profiles.claimCode', [
            'profileUser' => \Auth::user(),
            'userGamrAccount' => Account::userGameAccount(),
        ]);
    }

    public function changeEmail() {
        return view('profiles.settings.changeEmail', [
            'profileUser' => \Auth::user(),
            'userGamrAccount' => Account::userGameAccount(),
        ]);
    }

    public function changeEmailActoin(Request $request){
        if (!(\Hash::check($request->get('password'), \Auth::user()->password))) {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if($request->get('email') != $request->get('newEmailVerify')){
            return redirect()->back()->with("error","Mail does not match");
        }

        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        $user = \Auth::user();

        $account = Account::newEmail($user->email, $request->get('email'));

        //Change Email
        $user->email = $request->get('email');
        $user->save();

        return redirect()->back()->with("success","Email changed successfully!");

    }

    public function changePassword() {
        return view('profiles.settings.changePassword', [
            'profileUser' => \Auth::user(),
            'userGamrAccount' => Account::userGameAccount(),
        ]);
    }

    public function changePasswordActoin(Request $request){
        if (!(\Hash::check($request->get('oldPassword'), \Auth::user()->password))) {
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('oldPassword'), $request->get('newPassword')) == 0){
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        if($request->get('newPassword') != $request->get('newPasswordVerify')){
            return redirect()->back()->with("error","Passwords do not match");
        }

        $validatedData = $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|string|min:6',
        ]);

        $user = \Auth::user();

        $account = Account::newPassword($user->email, $request->get('newPassword'));

        //Change Password
        $user->password = bcrypt($request->get('newPassword'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }
}