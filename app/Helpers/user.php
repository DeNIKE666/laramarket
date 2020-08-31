<?php

function getName(\App\Models\User $user) {
    return $user->name ?: $user->email;
}