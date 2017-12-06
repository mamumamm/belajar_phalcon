<?php

class UserController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $data_user = User::find();
        $this->view->data_user = $data_user;
    }

    public function addUserAction()
    {
        $user = new User();

        if ($this->request->isPost()) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $type = $this->request->getPost('type');

            $user->assign(array(
                'username' => $username,
                'password' => $password,
                'type' => $type
            ));

            // $user->save();

            //Jika ingin menampilkan pop up
            if ($user->save()) {
                $notif['title']="Sukses";
                $notif['text']="Data telah berhasil disimpan";
                $notif['type']="succes";
            }else{
                $pesan_error = $user->getMessages();
                $data_pesan_error = '';
                foreach($pesan_error as $pesanError) {
                    $data_pesan_error="$pesan_error";
                }
                $notif['title']="Error";
                $notif['text']="Data tidak berhasil disimpan";
                $notif['type']="error";
            }
            echo json_encode($notif);
            die();
        }
    }

    public function editUserAction()
    {
        if ($this->request->isPost()) {
            $id = $this->request->getPost('id');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $type = $this->request->getPost('type');

            $user = User::findFirst("id='$id'");
            

            $user->assign(array(
                'id' => $id,
                'username' => $username,
                'password' => $password,
                'type' => $type
            ));

            // $user->save();

            //Jika ingin menampilkan pop up
            if ($user->save()) {
                $notif['title']="Sukses";
                $notif['text']="Data telah berhasil disimpan";
                $notif['type']="succes";
            }else{
                $pesan_error = $user->getMessages();
                $data_pesan_error = '';
                foreach($pesan_error as $pesanError) {
                    $data_pesan_error="$pesanError";
                }
                $notif['title']="Error";
                $notif['text']="Data tidak berhasil disimpan";
                $notif['type']="error";
            }
            echo json_encode($notif);
            die();
        }
    }

}

