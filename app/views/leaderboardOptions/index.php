<ul class="nav nav-tabs">
    <li class="nav-item">
        <a href="<?php echo Utility::getNewPath($data['path']) ?>"
           class="nav-link <?php echo $data['activeOption'] == null ? 'active' : ''; ?>">
            <?php echo $GLOBALS['lang']['topTen'] ?></a>
    </li>
    <li class="nav-item">
        <a href="<?php echo Utility::getNewPath($data['path'].'AllPlayers') ?>"
           class="nav-link <?php echo $data['activeOption'] == 'AllPlayers' ? 'active' : ''; ?>">
            <?php echo $GLOBALS['lang']['allUsers'] ?></a>
    </li>
    <li class="nav-item">
        <a href="<?php echo Utility::getNewPath($data['path'].'MyRank') ?>"
           class="nav-link <?php echo $data['activeOption'] == 'MyRank' ? 'active' : ''; ?>">
          <?php echo $GLOBALS['lang']['myRank'] ?></a>
    </li>
</ul>