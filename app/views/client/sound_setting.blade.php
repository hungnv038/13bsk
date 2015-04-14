<?php
//var_dump($settings); exit;
?>
<form role="form" action="" method="post" id="formSoundSetting">
    <div class="checkbox">
        <label><input type="checkbox" id="yellow_sound" <?php if($settings['yellow_sound']) echo 'checked' ?>> Báo âm thanh khi trận đấu thoả mãn điều kiện VÀNG </label>
    </div>
    <div class="checkbox">
        <label><input type="checkbox" id="red_sound" <?php if($settings['red_sound']) echo 'checked' ?>> Báo âm thanh khi trận đấu thoả mãn điều kiện ĐỎ </label>
    </div>
    <button type="button" class="btn btn-primary"
            onclick="SettingModule.saveSoundSetting(this); return false;">
        Lưu
    </button>
    <div class="alert alert-danger hidden" id="divresult"></div>
</form>