<?php require_once ('../app/views/langConfig.php')?>
<div class="footer bg-dark p-3 footer-p-3">
    <a href="/CommunityLeaderBoards/public/Language/en"
    style="color:  <?php echo SessionManager::get('lang') == 'en' ? 'white' : 'grey'?>"><?php echo $GLOBALS['lang']['lang_en'] ?></a>
    | <a href="/CommunityLeaderBoards/public/Language/hi"
         style="color:  <?php echo SessionManager::get('lang') == 'hi' ? 'white' : 'grey'?>"><?php echo $GLOBALS['lang']['lang_hi'] ?></a>
</div>
</body>
</html>