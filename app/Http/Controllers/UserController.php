<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function index() {
      $users = User::orderby('id', 'desc')->paginate(15);
      return view('backend.users.index', compact('users'));
    }

    public function create() {
      $user = new User();
      return view('backend.users.create', compact('user'));
    }

    public function store() {
      $data = $this->validateData();
      $data['password'] = Hash::make(request()->password);
      $user = User::create($data);

      if(request()->has('photo')) {
        $user->update([
          'photo' => request()->photo->store('uploads/users','public'),
        ]);
        $image = Image::make(public_path('storage/'.$user->photo))->fit(250,250);
        $image->save();
      }

      return redirect(url('/admin/users/create'))->with('status', 'İstifadəçi bazaya əlavə edildi...');
    }

    public function edit(User $user) {
      return view('backend.users.edit', compact('user'));
    }

    public function update(User $user) {
      $oldPassword = $user->password;
      $oldImage = $user->photo;
      $data = request()->validate([
        'name' => 'required',
        'fName' => 'required|min:5',
        'lName' => 'required|min:5',
        'email' => 'required|email',
        'password' => 'sometimes',
        'phone' => 'required|numeric',
        'country' => 'required',
        'city' => 'required',
        'level' => 'required',
        'street' => 'required',
        'photo' => 'sometimes|file|image|max:10000'
      ],[
        'name.required' => 'Istifadəçi logini boş ola bilməz!',
        'fName.required' => 'Ad boş ola bilməz!',
        'lName.required' => 'Soyad boş ola bilməz!',
        'phone.required' => 'Nömrə boş ola bilməz!',
        'country.required' => 'Ölkə boş ola bilməz!',
        'city.required' => 'Şəhər boş ola bilməz!',
        'street.required' => 'Küçə adresi boş ola bilməz!',
        'level.required' => 'Rütbə boş ola bilməz!',
        'password.required' => 'Şifrə boş ola bilməz!',
        'email.required' => 'Mail boş ola bilməz!',
        'email.email' => 'Mail daxil etməlisiniz',
        'lName.min' => 'Soyadın uzunluğu 6 dan böyük olmalıdır!',
        'fName.min' => 'Adın uzunluğu 6 dan böyük olmalıdır!',
        'phone.numeric' => 'Telefon nömrəsi ancaq rəqəmdən ibrarət olmalıdır boşuğa icazə verilmir!',
        'photo.file' => 'Yüklədiyiniz fayl olmalıdır!',
        'photo.image' => 'Yüklədiyiniz şəkil olmalıdır!',
        'photo.max' => 'Yüklədiyiniz şəkil 10 mb az olmalıdır!',
      ]);;
      if(empty(request()->password)) {
        $data['password'] = $oldPassword;
      } else {
        $data['password'] = Hash::make(request()->password);
      }
      $user->update($data);

      if(request()->has('photo')) {
        Storage::delete('public/'.$oldImage);
        $user->update([
          'photo' => request()->photo->store('uploads/users','public'),
        ]);
        $image = Image::make(public_path('storage/'.$user->photo))->fit(250,250);
        $image->save();
      }
      return redirect("/admin/users/".$user->id."/edit")->with('status', 'Istifadəçi redaktə edildi');
    }

    public function destroy(User $user) {
      Storage::delete('public/'.$user->photo);
      $user->delete();
      return redirect(url('/admin/users'))->with('status','İstifadəçi uğurlu şəkildə silindi');
    }

    public function validateData() {
      return request()->validate([
        'name' => 'required',
        'fName' => 'required|min:5',
        'lName' => 'required|min:5',
        'email' => 'required|email',
        'password' => 'required',
        'phone' => 'required|numeric',
        'country' => 'required',
        'city' => 'required',
        'level' => 'required',
        'street' => 'required',
        'photo' => 'sometimes|file|image|max:10000'
      ],[
        'name.required' => 'Istifadəçi logini boş ola bilməz!',
        'fName.required' => 'Ad boş ola bilməz!',
        'lName.required' => 'Soyad boş ola bilməz!',
        'phone.required' => 'Nömrə boş ola bilməz!',
        'country.required' => 'Ölkə boş ola bilməz!',
        'city.required' => 'Şəhər boş ola bilməz!',
        'street.required' => 'Küçə adresi boş ola bilməz!',
        'level.required' => 'Rütbə boş ola bilməz!',
        'password.required' => 'Şifrə boş ola bilməz!',
        'email.required' => 'Mail boş ola bilməz!',
        'email.email' => 'Mail daxil etməlisiniz',
        'password.min' => 'Şifrə uzunluğu 6 dan böyük olmalıdır!',
        'lName.min' => 'Soyadın uzunluğu 6 dan böyük olmalıdır!',
        'fName.min' => 'Adın uzunluğu 6 dan böyük olmalıdır!',
        'phone.numeric' => 'Telefon nömrəsi ancaq rəqəmdən ibrarət olmalıdır boşuğa icazə verilmir!',
        'photo.file' => 'Yüklədiyiniz fayl olmalıdır!',
        'photo.image' => 'Yüklədiyiniz şəkil olmalıdır!',
        'photo.max' => 'Yüklədiyiniz şəkil 10 mb az olmalıdır!',
      ]);
    }

}
