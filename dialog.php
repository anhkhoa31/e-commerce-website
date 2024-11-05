<?php
function show_dialog($type, $message) {
    if ($type == 'error') {
    echo
    "<div class='dialog'>
        <div class='dialog_body'>
            <div class='dialog_title'>
                <strong>Error</strong>
            </div>
            <div class='dialog_message'>
                $message
            </div>
            <button class='btn dialog_btn'>Close</button>
        </div>
    </div>";
    }
    if ($type == 'success') {
        echo
        "<div class='dialog'>
            <div class='dialog_body'>
                <div class='dialog_title'>
                    <strong>Success</strong>
                </div>
                <div class='dialog_message'>
                    $message
                </div>
                <button class='btn dialog_btn'>Close</button>
            </div>
        </div>";
    }
}
?>
