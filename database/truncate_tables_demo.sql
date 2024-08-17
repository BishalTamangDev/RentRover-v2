UPDATE room_tb SET tenant_id = 0, flag = 'verified';

TRUNCATE TABLE application_tb;
TRUNCATE TABLE issue_tb;
TRUNCATE TABLE leave_application_tb;
TRUNCATE TABLE notice_tb;
TRUNCATE TABLE notification_tb;
TRUNCATE TABLE review_tb;
TRUNCATE TABLE tenancy_tb;
TRUNCATE TABLE wishlist_tb;