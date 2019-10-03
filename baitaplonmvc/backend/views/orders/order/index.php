<?php require_once "views/layouts/header.php"; ?>
    <main class="app-content">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['success'] ?>
                <?php unset($_SESSION['success']); ?>
            </div>

        <?php endif; ?>
        <?php if (isset($_SESSION['fail'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['fail'] ?>
                <?php unset($_SESSION['fail']); ?>
            </div>

        <?php endif; ?>
        <form method="post" enctype="multipart/form-data"
              action="">

            <br>
            <br>
            <table class="table">
                <tr>


                    <th>Order ID</th>
                    <th>Name</th>

                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Ship</th>
                    <th>Total</th>
                    <th>Condition</th>
                    <th>Created At</th>
                    <th>Action</th>

                </tr>

                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                    <form method="post" enctype="multipart/form-data">
                        <tr>

                            <td><?php echo $order['id']; ?></td>

                            <td><?php echo $order['buyer_name']; ?></td>

                            <td><?php echo $order['product']; ?></td>

                            <td><?php echo $order['quantity']; ?></td>
                            <td><?php echo $order['ship']; ?></td>
                            <td><?php
                               $total=(int)$order['total']+(int)$order['ship'];
                               echo $total;
                                ?></td>
                            <td>
                            <?php
                            $selectedConditionShiped = '';
                            $selectedConditionNshiped = '';
                            if (isset($_POST['ship[<?php echo $order[\'id\'] ?>]'])){

                                switch ($_POST['ship[<?php echo $order[\'id\'] ?>]']){
                                    case Order::CONDITION_SHIPED:
                                        $selectedConditionShiped = "selected=true";
                                        break;
                                    case Order::CONDITION_NSHIPED:
                                        $selectedConditionNshiped = "selected=true";
                                        break;
                                }
                            }
                            ?>
                            <label>Status</label>
                            <select class="form-control" name="ship[<?php echo $order['id'] ?>]">

                                <option <?php echo $selectedConditionShiped?> value="<?php echo Order::CONDITION_SHIPED ?>">Shiped</option>
                                <option  <?php echo $selectedConditionNshiped ?> value="<?php echo Order::CONDITION_NSHIPED ?>">Didn't ship</option>
                            </select>
                            </td>

                            <td><?php echo date('d-m-Y H:i:s', strtotime($order['created_at'])); ?></td>

                            <td>
                               <button class="btn btn-primary" type="submit" name="conditionSubmit">Cập nhật</button>

                            </td>
                        </tr>
                    </form>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" style="text-align: center">Không có dữ liệu nào</td>
                    </tr>
                <?php endif; ?>

            </table>
        </form>
    </main>

<?php require_once "views/layouts/footer.php"; ?>