DELETE FROM `user_perms_chain` WHERE `user_perms` IN (
    SELECT `id` FROM `user_perms` WHERE `name` IN (
        'read_banner',
        'update_banner',
        'delete_banner',
        'create_banner'
    )
);

DELETE FROM `user_perms` WHERE `name` IN (
    'read_banner',
    'update_banner',
    'delete_banner',
    'create_banner'
);