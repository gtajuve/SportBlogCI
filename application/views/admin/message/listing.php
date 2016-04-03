<?php $this->load->view('admin/include/header');?>
<?php $this->load->view('admin/include/menu');?>
    <table>
        <thead>
        <tr>
            <th>Post at</th>
            <th>Username</th>
            <th>Отбор</th>
            <th>Заглавие</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tboby>
            <?php foreach($messages as $message):?>
                <tr>

                    <td><?=date('Y-F-d',(int)$message->reg_time)?></td>
                    <td><?=$message->username; ?></td>
                    <td><?=$message->team_name; ?></td>
                    <td><?=$message->title; ?></td>
                    <td><a href="update/<?=$message->id; ?>">Update</a></td>
                    <td><a href="delete/<?=$message->id; ?>">Delete</a></td>
                </tr>
            <?php endforeach;?>
        </tboby>
    </table>

<?php $this->load->view('admin/include/footer');?>