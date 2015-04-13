<?php

$start_type=HtmlHelper::TYPE_TWO_START;
$after_type=HtmlHelper::TYPE_TWO_AFTER;
if($rule_type==2) {
    $start_type=HtmlHelper::TYPE_TWO_START;
    $after_type=HtmlHelper::TYPE_TWO_AFTER;
} elseif($rule_type==3) {
    $start_type=HtmlHelper::TYPE_THREE_START;
    $after_type=HtmlHelper::TYPE_THREE_AFTER;
}
$after_odd = $rule->after_odd;
if ($rule->type == 4) {
    $after_odd = -99;
} elseif($rule->type==5) {
    $after_odd=-$rule->after_odd;
}
?>

<span id="spanError2" style="background-color: #ce8483"></span>

<form action="" id="editResource" name="editResource" class=""
      enctype="multipart/form-data">
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="multiSelect">Đầu trận :</label>

            <div class="controls">
                <select id="start_odd_edit"
                        class="form-control">
                    <?php HtmlHelper::makeSelection(5, $start_type, $rule->start_odd); ?>
                </select>
            </div>
        </div>


        <div class="control-group">
            <label class="control-label" for="multiSelect">45 + HT :</label>

            <div class="controls">
                <select id="after_odd_edit"
                        class="form-control">
                    <?php HtmlHelper::makeSelection(5, $after_type, $after_odd); ?>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="rule_color">Báo màu :</label>
            <select id="rule_color_edit" class="form-control">
                <option value="2" <?php if ($rule->color == 2) echo "selected"?>>Vàng</option>
                <option value="3" <?php if ($rule->color == 3) echo "selected"?>>Đỏ</option>
            </select>

        </div>
    </fieldset>
</form>