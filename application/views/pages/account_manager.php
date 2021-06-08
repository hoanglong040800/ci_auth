<h1 class="my-5"><?= $title ?></h1>



<table class="table table-striped table-bordered table-responsive-md">
    <thead>
      <tr>
        <th>Email</th>
        <th>Password</th>
        <th class="text-center">Role</th>
        <th>Created At</th>
        <th class="text-center w-25">Action</th>
      </tr>
    </thead>


    <tbody>
        <?php foreach($users as $user){ ?>
            <tr>
                <td><?= $user['email']?></td>

                <td><?= $user['password']?></td>
                
                <td class="text-center"><?= $user['role']?></td>
                
                <td><?= $user['created_at']?></td>
                
                <td class="d-flex justify-content-center">
                    <button class="btn btn-info mx-3">Edit</button>
                    <button class="btn btn-danger mx-3">Delete</button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
  </table>