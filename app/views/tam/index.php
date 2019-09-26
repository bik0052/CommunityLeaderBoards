<style>
    .scroll {
        height:350px;
        overflow-y: scroll;
    }
    .tam{
        background-color: mistyrose;
    }
</style>
<div class="container tam text-center">
    <div class="text-center">
        <br>
        <p class="h1"><?php echo $GLOBALS['lang']['tamTitle'] ?></p>
        <br>
        <p class="h2"><?php echo $GLOBALS['lang']['tamSubTitle'] ?></p>
        <br><br>
    </div>

    <div>
        <nav class="nav nav-pills nav-justified">

            <a class="nav-item nav-link <?php echo $data['active'] == 'Beginner' ? 'active' : ''; ?>"
               href="<?php echo Utility::getNewPath('TheseusAndTheMinotaur/Beginner') ?>"><?php echo $GLOBALS['lang']['beginner'] ?>
            </a>

            <a class="nav-item nav-link <?php echo $data['active'] == 'Easy' ? 'active' : ''; ?>"
               href="<?php echo Utility::getNewPath('TheseusAndTheMinotaur/Easy') ?>"><?php echo $GLOBALS['lang']['easy'] ?>
            </a>

            <a class="nav-item nav-link <?php echo $data['active'] == 'Hard' ? 'active' : ''; ?>"
               href="<?php echo Utility::getNewPath('TheseusAndTheMinotaur/Hard') ?>"><?php echo $GLOBALS['lang']['hard'] ?></a>

            <a class="nav-item nav-link <?php echo $data['active'] == 'Trivial' ? 'active' : ''; ?>"
               href="<?php echo Utility::getNewPath('TheseusAndTheMinotaur/Trivial') ?>"><?php echo $GLOBALS['lang']['trivial'] ?></a>

            <a class="nav-item nav-link <?php echo $data['active'] == 'Nightmare' ? 'active' : ''; ?>"
               href="<?php echo Utility::getNewPath('TheseusAndTheMinotaur/Nightmare') ?>"><?php echo $GLOBALS['lang']['nightmare'] ?></a>

        </nav>
        <br>
        <?php
        Utility::getPage("../app/views/leaderboardOptions/index", $data);
        ?>
    </div>
    <div class="scroll">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col"><?php echo $GLOBALS['lang']['rank'] ?></th>
                <th scope="col"><?php echo $GLOBALS['lang']['user'] ?></th>
                <th scope="col"><?php echo $GLOBALS['lang']['score'] ?></th>
                <th scope="col"><?php echo $GLOBALS['lang']['country'] ?></th>
            </tr>
            </thead>
            <?php
            $username = SessionManager::get('userName');
            if ($data['topPlayers'] != null) {
                foreach ($data['topPlayers'] as $key => $value) {
                    $rank = $value['rank'];
                    $player = $value['player'];
                    $score = $value['score'];
                    $country = $value['country'];
                    $colour = $player == $username ? 'class="table-success"' : '';
                    echo "<tr $colour><td>$rank</td><td>$player</td><td>$score</td><td>$country</td><tr>";
                }
            }
            ?>
        </table>
        <br><br>
        <p class="<?php echo $data['topPlayers'] == null ? 'p-3 mb-2 bg-danger text-white' : ''; ?>"><?php echo $data['topPlayers'] == null ? 'Ranks not available. Update your rank for this level.' : ''; ?></p>
    </div>
    <br><br>
    <form class="col-sm-6 form-inline justify-content-center" style="float: none; margin: 0 auto;" action="<?php echo Utility::getNewPath('TheseusAndTheMinotaur/update') ?>" method="post">
        <div class="form-group mx-sm-3 mb-2">
            <input type="number" class="form-control" name="score" placeholder="New Score">
        </div>
        <input class="btn btn-primary mb-2" type="submit" value="<?php echo $GLOBALS['lang']['updateScore'] ?>">
        <input type="hidden" name="maze" value="<?php echo $data['active'] ?>">
        <input type="hidden" name="boardID" value="<?php echo $data['boardID'] ?>">
    </form>
    <br><br>
    <span class="mx-sm-3 mb-2 p-3 <?php echo isset($data['scoreErr']) ? 'bg-danger' : ''; ?>"><?php isset($data['scoreErr']) ? Utility::sanitiseOutput($data['scoreErr']) : ''; ?></span>
</div>
<?php Utility::getPage('../app/views/footer/footer') ?>
