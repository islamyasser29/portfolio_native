<?php
function getNullMessage($label)
{
    return "<div class='alert alert-danger text-center text-danger ' role='alert'>please insert the value of $label</div>";
}
function getNonNumericMessage($label)
{
    return "<div class='alert alert-danger text-center text-danger ' role='alert'>the value of $label must be digits</div>";
}
function getSuccessMessage()
{
    return "<div class='alert alert-success text-center text-success'>success</div>";
}
function getFailMessage()
{
    return "<div class='alert alert-danger text-center text-danger ' role='alert'>fail</div>";
}
function getMessage($message)
{
    return "<div class='alert alert-danger text-center text-danger '>$message</div>";
}