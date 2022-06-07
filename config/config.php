<?php	
	/* photo upload path */
	define ('PHOTO_PATH', '../../assets/images/photos/');
	
	/* photo upload path */
	define ('LOGO_UPLOAD_PATH', '../../assets/images/');

	/* document upload path */
	define ('DOCUMENT_UPLOAD_PATH', '../../uploads/documents/');

	/* image upload path */
	define ('IMAGE_UPLOAD_PATH', '../../uploads/images/');

	/* views path */
	define ('VIEWS_PATH', 'views/');
	
	/* 'select' select option */
	define ('OPTION_SELECT', '--Select--');	
	
	/* 'none' select option */
	define ('OPTION_NONE', '--None--');
	
	/* 'N/A' select option */
	define ('OPTION_NA', '---');
	
	/* number of records to process as a batch *
	define ('BATCH_RECORDS_PROCESS', 20);
	
	/* invoice times: registration *
	define ('INVOICE_TIME_REGISTRATION', 'Registration');

	/* invoice times: yearly *
	define ('INVOICE_TIME_YEARLY', 'Yearly');

	/* invoice times: TEP *
	define ('INVOICE_TIME_TEP', 'TEP');
	
	/* invoice times: adhoc *
	define ('INVOICE_TIME_ADHOC', 'Adhoc');

	/* receipt serial number length *
	define ('RECEIPT_NUMBER_LENGTH', 5);
	
	/* invoice serial number length *
	define ('INVOICE_NUMBER_LENGTH', 5);
	
	/* document categories: registration proof of payment *
	define ('DOCUMENT_CATEGORY_PAYMENT_PROOF_REGISTRATION', 'Payment Proof Registration'); 

	/* document categories: consitution *
	define ('DOCUMENT_CATEGORY_CONSTITUTION', 'Constitution'); 

	/* document categories: certificate of incorporation *
	define ('DOCUMENT_CATEGORY_INCORPORATION', 'Certificate of Incorporation'); 

	/* document categories: activities plan *
	define ('DOCUMENT_CATEGORY_ACTIVITIES_PLAN', 'Activities Plan');

	/* document categories: government approval *
	define ('DOCUMENT_CATEGORY_GOVERNMENTAL_APPROVAL', 'Government Approval');

	/* document categories: association membership *
	define ('DOCUMENT_CATEGORY_ASSOCIATION_MEMBERSHIP', 'Association Membership');

	/* document categories: sworn affidavit *
	define ('DOCUMENT_CATEGORY_SWORN_AFFIDAVIT', 'Sworn Affidavit');

	/* document categories: additional document *
	define ('DOCUMENT_CATEGORY_ADDITIONAL_DOCUMENT', 'Additional Document');

	/* document categories: license renewal proof of payment *
	define ('DOCUMENT_CATEGORY_PAYMENT_PROOF_LICENSE', 'Payment Proof License'); 

	/* document categories: TPE processing certificate proof of payment *
	define ('DOCUMENT_CATEGORY_PAYMENT_PROOF_TPE', 'Payment Proof TPE'); 

	/* document categories: annual technical report *
	define ('DOCUMENT_CATEGORY_TECHNICAL_REPORT', 'Annual Technical Report'); 

	/* document categories: audited financial statements *
	define ('DOCUMENT_CATEGORY_FINANCIAL_STATEMENT', 'Audited Financial Statements'); 

	/* registration certificate *
	define ('CERTIFICATE_REGISTRATION', 'Certificate of Registration');

	/* annual license *
	define ('CERTIFICATE_LICENSE', 'License');

	/* TEP Processing Certificate *
	define ('CERTIFICATE_TEP', 'Temporary Employment Permit Processing Certificate');*/
	
	/* successful actions on records */
	define ('MESSAGE_SUCCESS', ' successfully ');
	define ('MESSAGE_SUCCESS_TYPE', 'success');
	
	/* errors on record processing */
	define ('MESSAGE_ERROR', 'An error was encountered while processing your request ');
	define ('MESSAGE_ERROR_TYPE', 'error');

	/* information on record processing */
	define ('MESSAGE_INFORMATION_TYPE', 'info');
	define ('ICON_INFORMATIOM', 'info-circle');

	/* message for existing records */
	define ('MESSAGE_EXIST', ' already exists');

	/* message for lesser end date than start date */
	define ('MESSAGE_LESSER_END_DATE', ' end date is lesser than start date');

	/* message for existing records */
	define ('MESSAGE_UNFILLED_DATE_FIELDS', ' end date and start date must be filled');

	/* message for records in use */
	define ('MESSAGE_IN_USE', ' is currently in use');

	/* message for exhausted leave days */
	define ('MESSAGE_EXHAUSTED', ' has requested more days than located or has fewer remaining days than requested');

	/* message for disabled action */
	define ('MESSAGE_DISABLED', 'This operation is currently disabled');
	
	/* message for licensed licensee */
	define ('MESSAGE_LICENSED', ' is already licensed');
	
	/* status for active records */
	define ('STATUS_ACTIVE', 'active');
		
	/* status for deleted records */
	define ('STATUS_DELETED', 'deleted');

	/* status for rejected records */
	define ('STATUS_REJECTED', 'rejected');	

	/* approval statuses */
	$APPROVAL_STATUS = array(
		"0" => "Draft",
		"1" => "Level 1 Approval",
		"2" => "Level 2 Approval",
		"3" => "Approved",
		"4" => "Rejected",
		"5" => "Disabled"
	);	
	
	/* maximum number of items in a graph */
	define ('MAX_ITEMS_IN_GRAPH', 8);
	
	$REPORT_PERIODS = array(
		//"0" => "Weekly",                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ?
		"1" => "Monthly",
		"2" => "Quarterly",
		"3" => "Semi-Annually",
		"4" => "Annually",
	);	
	
	/* status for drafted applications */
	define ('AWAITING_APPROVAL_1', 'Awaiting Level 1 Approval');

	/* common menu items which should be available on every user's menu */
	define ('COMMON_MENU_ITEMS', '|Dashboard|');
	
	/* password salt length */
	define ('SALT_LENGTH', 10);

	/* common icons */
	define ('ICON_CHECK', 'check');
	define ('ICON_CHECK_SQUARE', 'check-square-o');
	define ('ICON_CHECK_CIRCLE', 'check-circle-o');
	define ('ICON_CROSS', 'times');
	define ('ICON_CROSS_CIRCLE', 'times-circle-o');
	
	/* colors for statuses */
	define ('COLOR_BLUE', '#060259');
	define ('COLOR_GREEN', '#009900');
	define ('COLOR_AMBER', '#ffaa00');
	define ('COLOR_RED', '#ff0000');
		
	/* record controls */
	define ('REC_CONTROL_ZERO', '0');
	define ('REC_CONTROL_ONE', '1');
	define ('REC_CONTROL_TWO', '2');
	define ('REC_CONTROL_THREE', '3');
	
	/* salting */
	define ('SALT_PWD_LENGTH', 10);
	define ('SALT_KEY_LENGTH', 2);

	/* maximum notice title preview length */
	define ('MAX_NOTICE_TITLE_PREVIEW_LENGTH', 170);
	
	/* maximum news preview length */
	define ('MAX_NOTICE_PREVIEW_LENGTH', 300);

	/* place holder for parent menus */
	define ('MENU_PARENT_PLACEHOLDER', '___MENU_PARENT_PLACEHOLDER___');
			
	/* common place holder */
	define ('COMMON_PLACEHOLDER', '___COMMON_PLACEHOLDER___');	

	/* maximum account lockout duration */
	define ('ACCOUNT_LOCKOUT_DURATION', 30);
	
	/* maximum account lockout threshold */
	define ('ACCOUNT_LOCKOUT_THRESHOLD', 10);
	
	/* maximum file upload size */
	define ('MAX_FILE_IMPORT_SIZE', 1.5);

	/* maximum weight for menu items */
	define ('MAX_WEIGHT', 20);	
	
	/* maximum number of fields for student registration number format */
	define ('MAX_REG_NUMBER_FORMAT_FIELDS', 6);	
	
	/* minimum number of fields for student registration number format */
	define ('MIN_REG_NUMBER_FORMAT_FIELDS', 3);	
	
	/* serial number for student registration number format */
	define ('REG_NUMBER_FORMAT_SERIAL_NUMBER', 'serial_number');	

	/* non display fileds from database tables */
	define ('NON_DISPLAY_FIELDS', '|password|captured_by|captured_date|last_edited_by|last_edited_date|deleted_by|deleted_date|change_password|log_attempts|');	
	
	/* 
	 * a collection of icons (using FontAwesome)
	 * format: icon => array(hex code, description);
	 */
	$icons = array(
		"fa fa-address-book-o" => array("&#xf2ba;", "Address Book"), 
		"fa fa-arrow-left" => array("&#xf060;", "Arrow Left"),
		"fa fa-arrow-circle-o-left" => array("&#xf190;", "Arrow Left (Circle)") ,
		"fa fa-arrow-right" => array("&#xf061;", "Arrow Right"),
		"fa fa-arrow-circle-o-right" => array("&#xf18e;", "Arrow Right (Circle)"),
		"fa fa-bar-chart" => array("&#xf080;", "Bar Chart"), 
		"fa fa-book" => array("&#xf02d;", "Book"), 
		"fa fa-briefcase" => array("&#xf0b1;", "Briefcase"), 		 
		"fa fa-building" => array("&#xf1ad;", "Building"), 
		"fa fa-calendar" => array("&#xf073;", "Calendar"), 
		"fa fa-calendar-o" => array("&#xf133;", "Calendar (Clear)"),		
		"fa fa-certificate" => array("&#xf0a3;", "Certificate"),
		"fa fa-check" => array("&#xf00c;", "Check"),
		"fa fa-check-circle-o" => array("&#xf05d;", "Check (Circle)"),
		"fa fa-check-square-o" => array("&#xf046;", "Check (Square)"), 
		"fa fa-clock-o" => array("&#xf017;", "Clock"), 
		"fa fa-comment" => array("&#xf075;", "Comment"), 
		"fa fa-comment-o" => array("&#xf0e5;", "Comment (Open)"), 
		"fa fa-commenting" => array("&#xf27a;", "Commenting"), 
		"fa fa-commenting-o" => array("&#xf27b;", "Commenting (Open)"), 		
		"fa fa-comments" => array("&#xf086;", "Comments"), 
		"fa fa-comments-o" => array("&#xf0e6;", "Comments (Open)"), 
		"fa fa-gear" => array("&#xf013;", "Configuration"), 
		"fa fa-cube" => array("&#xf1b2;", "Cube"),
		"fa fa-cubes" => array("&#xf1b3;", "Cubes"),
		"fa fa-usd" => array("&#xf155;", "Dollar"), 
		"fa fa-file" => array("&#xf15b;", "File (Closed)"), 
		"fa fa-file-o" => array("&#xf016;", "File (Open)"), 
		"fa fa-files-o" => array("&#xf0c5;", "Files"), 
		"fa fa-folder-o" => array("&#xf114;", "Folder"), 
		"fa fa-folder-open-o" => array("&#xf115;", "Folder (Open)"), 
		"fa fa-th-list" => array("&#xf00b;", "Format"),
		"fa fa-object-group" => array("&#xf247;", "Group"),
		"fa fa-university" => array("&#xf19c;", "Institution"), 
		"fa fa-drivers-license" => array("&#xf2c2;", "License"), 
		"fa fa-drivers-license-o" => array("&#xf2c3;", "License (Open)"), 
		"fa fa-line-chart" => array("&#xf201;", "Line Chart"), 
		"fa fa-bars" => array("&#xf0c9;", "Menu"),
		"fa fa-newspaper-o" => array("&#xf1ea;", "Newspaper"), 
		"fa fa-undo" => array("&#xf0e2;", "Reversal"),
		"fa fa-refresh" => array("&#xf021;", "Refund"),
		"fa fa-gears" => array("&#xf085;", "Settings"), 
		"fa fa-share" => array("&#xf064;", "Sharing"), 
		"fa fa-share-square" => array("&#xf14d;", "Sharing (Square)"), 
		"fa fa-share-square-o" => array("&#xf045;", "Sharing (Square, Open)"), 
		"fa fa-window-maximize" => array("&#xf2d0;", "System"),
		"fa fa-file-text" => array("&#xf15c;", "Text (Closed)"),
		"fa fa-file-text-o" => array("&#xf0f6;", "Text (Open)"),
		"fa fa-object-ungroup" => array("&#xf248;", "Ungroup"),
		"fa fa-unlock-alt" => array("&#xf13e;", "Unlock"), 
		"fa fa-user" => array("&#xf007;", "User"), 
		"fa fa-users" => array("&#xf0c0;", "User Group"),
		"fa fa-user-o" => array("&#xf2c0;", "User (Clear)"), 
		"fa fa-user-plus" => array("&#xf234;", "User (Plus)")		
	);
	
	/* image file extensions */
	$IMG_FILE_EXT = array("gif", "jpeg", "jpg", "png");
		
	/* document file extensions */
	$DOC_FILE_EXT = array("pdf", "doc", "docx");
	
	/* upload file extensions */
	$upload_file_extensions = array("csv", "txt");
	
	/* PDF file extension */	
	define ('PDF_FILE_EXT', 'pdf');
	
	/* Excel file extension */	
	define ('XLSX_FILE_EXT', 'pdf');
	
	/* Image field type */	
	define ('FIELD_TYPE_IMG', 'IMG');
	
	/* Text field type */	
	define ('FIELD_TYPE_TXT', 'TXT');	

	/* system directory */
	define ('SYS_DIR', 'lms');

	/* sytsem url */
	define ('SYS_URL', 'http://localhost/lms/');

	/* table prefix */
	define ('TABLE_PREFIX', 'lms_');

	/* table prefix */
	define ('DATABASE_NAME', 'lms.');

	/* email settings */
	define ('EMAIL_DISPLAY_NAME', 'myLMS');
	define ('MAIL_HOST', 'mail.idiasmw.com');
	define ('MAIL_PORT', '2525');
	define ('MAIL_ENCRYPTION', 'tls');
	define ('FROM_EMAIL', 'bmalola@idiasmw.com');
	define ('EMAIL_PASSWORD', 'Testing123!');

	/**
	 * database connection
	 */
	class config
	{
		static function connect() {
			$servername = "localhost";
			$username = "root";
			$password = "admin";
			$db = "lms";
			
			$conn = new mysqli($servername, $username, $password, $db);
			return $conn;
		}
	}
?>