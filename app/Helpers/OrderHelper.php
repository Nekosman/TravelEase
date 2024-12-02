<?php

function getApprovalStatus($isApproved)
{
    return $isApproved ? 'Active' : 'Not Active';
}
