<?php include "inc/header.php"; ?>
    <!-- CRUD With PDO + Abstract Factory Pattern -->
<?php

spl_autoload_register(function($className) {
    include "classes/" . $className . ".php";
});

$user = new Student();


if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $dep = $_POST['dep'];
    $age = $_POST['age'];

    $user->setName($name);
    $user->setDep($dep);
    $user->setAge($age);

}


if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $dep = $_POST['dep'];
    $age = $_POST['age'];
    $id = $_POST['id'];

    $user->setName($name);
    $user->setDep($dep);
    $user->setAge($age);

    $user->updateById($id);


}


if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = (INT)$_GET['id'];
    $user->deleteById($id);
    if ($user->deleteById($id)){
        echo "<span class='delete'>Data Deleted successfully...</span>";
    }
}

?>


    <section class="mainleft">

        <?php
        if (isset($_GET['action']) && $_GET['action'] == 'update') :
            $id = $_GET['id'];
            $result = $user->readById($id);

            ?>
            <form action="" method="post">
                <?php

                if ($user->updateById($id)) {
                    echo "<span class='insert'>Data updated successfully...</span>";
                }

                ?>
                <table>
                    <tr>
                        <td>Name:</td>
                        <td><input type="text" name="name" value="<?php echo $result['name']; ?>"/></td>
                    </tr>

                    <tr>
                        <td>Department:</td>
                        <td><input type="text" name="dep" value="<?php echo $result['dep']; ?>"/></td>
                    </tr>

                    <tr>
                        <td>Age:</td>
                        <td><input type="text" name="age" value="<?php echo $result['age']; ?>"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $result['id']; ?>"/>
                            <input type="submit" name="update" value="Submit"/>
                            <input type="reset" value="Clear"/>
                        </td>
                    </tr>
                </table>
            </form>

        <?php else : ?>

            <form action="" method="post">
                <?php

                if ($user->insert()) {
                    echo "<span class='insert'>Data inserted successfully...</span>";
                }

                ?>
                <table>
                    <tr>
                        <td>Name:</td>
                        <td><input type="text" name="name" required="1"/></td>
                    </tr>

                    <tr>
                        <td>Department:</td>
                        <td><input type="text" name="dep" required="1"/></td>
                    </tr>

                    <tr>
                        <td>Age:</td>
                        <td><input type="text" name="age" required="1"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="create" value="Submit"/>
                            <input type="reset" value="Clear"/>
                        </td>
                    </tr>
                </table>
            </form>
        <?php endif; ?>

    </section>


    <section class="mainright">
        <table class="tblone">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Department</th>
                <th>Age</th>
                <th>Action</th>
            </tr>

            <?php $i = 0;
            foreach ($user->readAll() as $value) : $i++; ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td><?php echo $value['dep']; ?></td>
                    <td><?php echo $value['age']; ?></td>
                    <td>
                        <?php echo "<a href='index.php?action=update&id=" . $value['id'] . "'>Edit</a>"; ?> ||
                        <?php echo "<a href='index.php?action=delete&id=" . $value['id'] . "' onclick='return confirm(\"Are you sure to delete this data?\")'>Delete</a>"; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </section>


<?php include "inc/footer.php"; ?>