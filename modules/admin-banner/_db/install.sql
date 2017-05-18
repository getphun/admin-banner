INSERT IGNORE INTO `user_perms` ( `name`, `group`, `role`, `about` ) VALUES
    ( 'create_banner',  'Banner', 'Management', 'Allow user to create new banner' ),
    ( 'read_banner',    'Banner', 'Management', 'Allow user to view all banners' ),
    ( 'remove_banner',  'Banner', 'Management', 'Allow user to remove exists banner' ),
    ( 'update_banner',  'Banner', 'Management', 'Allow user to update exists banner' );