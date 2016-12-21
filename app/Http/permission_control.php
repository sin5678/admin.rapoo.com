 <?php
 

Entrust::routeNeedsRole( 'admins', ['admin_system'] );
Entrust::routeNeedsRole( 'roles', ['admin_system'] );
Entrust::routeNeedsRole( 'permission', ['admin_system'] );
Entrust::routeNeedsRole( 'banners', ['manage_banner|admin_system'] );

Entrust::routeNeedsRole( 'articles', ['admin_system'] );
Entrust::routeNeedsRole( 'users', ['admin_system'] );
Entrust::routeNeedsRole( 'categories', ['admin_system'] );