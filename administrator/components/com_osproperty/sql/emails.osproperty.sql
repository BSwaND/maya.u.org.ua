INSERT INTO `#__osrs_emails` (`id`, `email_key`, `email_title`, `email_content`, `published`) VALUES
(1, 'payment_accept', 'Payment has been successfully accepted.', 'Dear {username},\r\n\r\nYour payment has been successfully accepted.\r\nPayment details:\r\nGateway: {gateway}\r\nTransaction ID: {txn}\r\nItem: {item}\r\nItem Price: {price}\r\nDate: {date}\r\n\r\n______________________________\r\nThank you,\r\n{site_name}\r\nAdministration Team\r\n', 1),
(2, 'free_approval_listing_created', 'Your Listing was successfully added to {site_name}', 'Dear Sir/Madam,\r\n\r\nNew Listing was successfully added to {site_name}, but it hadn''t approved yet, please wait for administrator activation.\r\nNow you can manage new listing details, add photos or video to your listing.\r\n\r\nUse following link to manage your listing:\r\n{link}\r\n\r\n______________________________\r\nThank you,\r\n{site_name}\r\nAdministration Team', 1),
(3, 'not_paid_listing_created', 'Your Listing was successfully added to {site_name}', 'Dear Sir/Madam,\r\n\r\nNew Listing was successfully added to {site_name}, this listing has unpaid status, you should make a payment, for approving your listing.\r\n\r\nPlease, use following link to make a payment:\r\n{link}\r\n\r\n______________________________\r\nThank you,\r\n{site_name}\r\nAdministration Team', 1),
(4, 'listing_expired_email', 'Your listing has been expired!', 'Dear {username},\r\n\r\nYour listing "{listing}" has now expired.\r\nPlease login to {site_name} in order to renew your listing.\r\nClick the following link to go to directly to the update page:\r\n{update_link}\r\nListing Details:\r\n{details_link}\r\n\r\n______________________________\r\nThank you,\r\n{site_name}\r\nAdministration Team', 1),
(5, 'comment_send_after_ad', 'Added new comment', 'Dear {username},\r\n\r\nIn your listing was added a new comment.\r\n<b>Author:</b> {author}\r\n<b>Title:</b> {title}\r\n<b>Message:</b> {message}\r\n<b>Rate:</b> {rate}\r\n____________________________________________________________\r\n\r\nIf you want look this message please click this link: {link}\r\n\r\nJust ignore or delete this message if you are not.\r\n______________________________\r\nThank you,\r\n{site_name}\r\nAdministration Team', 1),
(6, 'listing_activated', 'Listing has been activated in {site_name}', 'Dear {username},\r\n\r\nYour listing "{listing}" in {site_name} was activated.\r\nPlease click the following link to view listing details page:\r\n{link}\r\n\r\n______________________________\r\nThank you,\r\n{site_name}\r\nAdministration Team', 1),
(7, 'listing_deactivated', 'Listing has been deactivated in {site_name}', 'Dear {username},\r\n\r\nYour listing "{listing}" in {site_name} was deactivated by administrator.\r\nPlease contact site administrators to get details about this issue.\r\n{site_name}\r\n\r\n______________________________\r\nThank you,\r\n{site_name}\r\nAdministration Team', 1),
(8, 'tell_friend', '-Tell a Friend- form notification', 'Dear {friend_name},\r\n\r\nYour friend {name} wish to inform you about following listing, \r\nclick following link to check it:\r\n{link}\r\n\r\n{message}\r\n\r\nThank You!\r\n{site_name}\r\nAdministration Team', 1),
(9, 'featured_expire_listing', 'Your listing featured has been expired!', 'Dear {username},\r\nYour listing featured "{listing}" has been expired!\r\nYou may login to {site_name} and update (renew) your featured listing.\r\nClick the following link to go directly to the update page:\r\n{update_link}\r\nListing Details:\r\n{details_link}\r\n\r\n______________________________\r\nThank you,\r\n{site_name}\r\nAdministration Team', 1),
(10, 'new_property_inform', 'New property has been submitted', 'Dear Administrator,\r\nUser {customer} has just submitted new property. \r\nProperty details here :\r\n{property_details}\r\nPlease go this link to see the property details {link}\r\nThanks', 1),
(11, 'new_property_confirmation', 'You have submitted new property', 'Dear {customer},\r\nYou have just submitted new property\r\nHere is the details:\r\n{property_details}\r\n{information}\r\nThanks', 1),
(12, 'new_message_received', 'New message from {visitor_name} at {site_name}', 'Dear {received_name},\r\n\r\nYou have new message from {visitor_name} at {site_name}.\r\nSubject: {subject}\r\n{contact_email}\r\n\r\n{message}\r\n\r\nThank You!\r\n{site_name}\r\nAdministration Team\r\n{site_url}', 1),
(13, 'approximates_email', 'Your listing plan approximates to expiration date.', 'Dear {username},\r\n\r\nYour listing will be expire after {days} days ({expire_date}).\r\nYou may login to {site_name} and update your listing plan.\r\nClick the following link to go update page:\r\n{update_link}\r\nListing details\r\n{details_link}\r\n\r\n______________________________\r\nThank you,\r\n{site_name}\r\nAdministration Team', 1),
(14, 'request_approval_agent', 'New agent approval request', 'Dear Administrator,\r\nUser {customer} has just submitted agent approval request.\r\nPlease go this link to see the agent details {link}\r\nThanks', 1),
(15, 'request_approval_property', 'New property approval request', 'Dear Administrator,\r\nUser {customer} has just submitted property approval request.\r\nProperty : {property}\r\nPlease go this link to see the property details {link}\r\nThanks', 1),
(16, 'approval_agent_request', 'Your agent request has been approval', 'Dear {agent},\r\n\r\nYour agent registration request has been approved bty administrator. \r\nNow, you can add your property. \r\nYour sincerely,\r\n{site_name}', 1),
(17, 'featured_listing_activated', 'Feature listing has been activated in {site_name}', 'Dear {username},\r\n\r\nYour listing "{listing}" in {site_name} was activated.\r\nPlease click the following link to view listing details page:\r\n{link}\r\n\r\n______________________________\r\nThank you,\r\n{site_name}\r\nAdministration Team', 1),
(18, 'featured_listing_deactivated', 'Feature listing has been deactivated in {site_name}', 'Dear {username},\r\n\r\nYour feature listing "{listing}" in {site_name} was deactivated by administrator.\r\nPlease contact site administrators to get details about this issue.\r\n{site_name}\r\n\r\n______________________________\r\nThank you,\r\n{site_name}\r\nAdministration Team', 1),
(19, 'comment_add_send_to_admin', 'New submitted comment need approval', 'Dear Administrator,\r\n\r\nIn listing "{listing}" was added a new comment.\r\n<b>Author:</b> {author}\r\n<b>Title:</b> {title}\r\n<b>Message:</b> {message}\r\n<b>Rate:</b> {rate}\r\n____________________________________________________________\r\n\r\nIf you want look this message please click this link: {link}\r\n\r\nJust ignore or delete this message if you are not.', 1),
(20, 'new_company_registration', 'New company has been registered on your site', '<p>Dear admin,</p>\r\n<p>{user} has registered new company information on your site. Company name is {company_name}</p>\r\n<p>Please click {company_backend_url) to check company details and decide to approve it.<br /><br /></p>\r\n<p>Thanks</p>', 1),
(21, 'your_company_has_been_approved', 'Your company information has been approved', '<p>Dear {company_admin}</p>\n<p>Your company ({company_name}) has been approved by administrator.</p>\n<p>Please click {company_edit_profile} to go to the company information page</p>\n<p>Thanks</p>', 1),
(22, 'email_alert', 'New properties uploaded', '<h1 style="text-align: center;"><strong>New properties uploaded</strong></h1>\r\n<p style="text-align: center;">Dear customer, new properties have been uploaded that suit with your Saved Search list <strong>{listname}</strong>. Please take a look at this them bellow</p>\r\n<p style="text-align: center;">�{new_properties}</p>\r\n<p style="text-align: left;"><em>If you don''t want to receive this email, please click this link</em> {cancel_alert_email_link}</p>', 1);