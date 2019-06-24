<!--End Sidebar-->
<div class="content">
    <div class="container-fluid">
        <br>
        <p style="text-align:right; font-weight: regular; font-size: 16px">
            <!-- Real Time Date & Time -->
            <?php echo date("M j, Y -l"); ?>
        </p>
    </div>
    <div class="card" style="width: 35rem; margin-left: 275px;">
        <div class="card-body">
            <canvas id="sales"></canvas>
        </div>
    </div>
    <div class="card" style="width: 35rem; margin-left: 275px;">
        <div class="card-body">
            <canvas id="revenue"></canvas>
        </div>
    </div>
    <div class="card" style="width: 25rem;margin-left: 275px;">
        <div class="card-body text-center">
            <h5 class="card-title"><b>Stock Items Needed to Restock<b><h5>
            <?php if(count($stockroom) > 0) { ?>
                <table>
                <tr>
                    <th>Menu Items</th>
                    <th>Actual</th>
                    <th>Minimum</th>
                </tr>
                <?php foreach($stockroom as $st) { ?>
                <tr>
                    <td><?= $st->stock ?></td>
                    <td><?= $st->stQty ?></td>
                    <td><?= $st->stMin ?></td>
                </tr>
                <?php } ?>
                </table>
            <?php } else { ?>
                    <h5><i class="fa fa-check"></i> You have no insufficient stocks.</h5>
            <?php } ?>
            </table>
        </div>
    </div>
    <div class="card" style="width: 25rem;margin-left: 275px;">
        <div class="card-body text-center">
            <h5 class="card-title"><b>Kitchen Items Needed to Restock<b><h5>
            <br>
            <?php if(count($kitchen) > 0) { ?>
                <table class="table">
                <tr>
                    <th>Menu Items</th>
                    <th>Actual</th>
                    <th>Minimum</th>
                </tr>
                <?php foreach($kitchen as $st) { ?>
                <tr>
                    <td><?= $st->stock ?></td>
                    <td><?= $st->stQty ?></td>
                    <td><?= $st->stMin ?></td>
                </tr>
                <?php } ?>
                </table>
            <?php } else { ?>
                    <h5><i class="fa fa-check"></i> You have no insufficient stocks.</h5>
            <?php } ?>
            </table>
        </div>
    </div>
</div>