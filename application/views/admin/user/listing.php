<?php $this->load->view('admin/include/header');?>
<?php $this->load->view('admin/include/menu');?>
    <table>
        <thead>
        <tr>
            <th>Username</th>
            <th>Mail</th>
            <th>Gender</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tboby>
            <?php foreach($users as $user):?>
            <tr>
                <td><?=$user->username; ?></td>
                <td><?=$user->email; ?></td>
                <td><?=$user->gender; ?></td>
                <td><a href="update/<?=$user->id; ?>">Update</a></td>
                <td><a href="delete/<?=$user->id; ?>">Delete</a></td>
            </tr>
            <?php endforeach;?>
        </tboby>
    </table>

<?php $this->load->view('admin/include/footer');?>