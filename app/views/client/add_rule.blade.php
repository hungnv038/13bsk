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
?>
<span id="spanError1" style="background-color: #ce8483"></span>

<form action="" id="newResource" name="newResource" class=""
      enctype="multipart/form-data">
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="multiSelect">Đầu trận :</label>

            <div class="controls">
                <select id="start_odd"
                        class="form-control">
                    <?php HtmlHelper::makeSelection(5, $start_type); ?>
                </select>
            </div>
        </div>


        <div class="control-group">
            <label class="control-label" for="multiSelect">45 + HT :</label>

            <div class="controls">
                <select id="after_odd"
                        class="form-control">
                    <?php HtmlHelper::makeSelection(5, $after_type); ?>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="rule_color">Báo màu :</label>
            <select id="rule_color" class="form-control">
                <option value="2">Vàng</option>
                <option value="3">Đỏ</option>
            </select>

        </div>
    </fieldset>
</form>