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
        <div class="card-body text-center">
            <h5 class="card-title"><b>Sales for <?= date("Y") ?></b></h5>            
            <canvas id="sales"></canvas>
        </div>
    </div>
    <div class="card" style="width: 35rem; margin-left: 275px;">
        <div class="card-body text-center">
            <h5 class="card-title"><b>Revenue for <?= date("Y") ?></b></h5>
            <canvas id="revenue"></canvas>
        </div>
    </div>
    <div class="card" style="width: 25rem;margin-left: 275px;">
        <div class="card-body text-center">
            <h5 class="card-title"><b>Stockroom Items Needed to Restock<b><h5>
            <?php if(count($stockroom) > 0) { ?>
                <table>
                <tr>
                    <th>Item</th>
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
                    <th>Item</th>
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
    <div class="card" style="width: 25rem;margin-left: 275px;">
        <div class="card-body text-center">
            <h5 class="card-title"><b>Top 10 Selling Menu for the Month<b></h5>
            <?php if(count($topmenu) > 0) { ?>
                <table class="table">
                <tr>
                    <th>Rank</th>
                    <th>Menu Item</th>
                    <th>Sales Count</th>
                </tr>
                <?php $x=1; foreach($topmenu as $tpm) { ?>
                <tr>
                    <td><?= $x ?></td>
                    <td><?= $tpm->mName ?></td>
                    <td><?= $tpm->salesCount ?></td>
                </tr>
                <?php $x++; } ?>
                </table>
            <?php } else { ?>
                    <h5><i class="fa fa-times"></i> There is no sale recorded.</h5>
            <?php } ?>
            </table>
        </div>
    </div>
    <div class="card" style="width: 15rem; margin-left: 275px;">
        <div class="card-body text-center">
            <h5 class="card-title"><b>Total Sales for the Month</b></h5>
            <h5><?= $tSales[0]->total ?></h5>
        </div>
    </div>
    <div class="card" style="width: 15rem; margin-left: 275px;">
        <div class="card-body text-center">
            <h5 class="card-title"><b>Total Sales for the Month</b></h5>
            <h5><?= $tRevenue[0]->total ?></h5>
        </div>
    </div>
</div>