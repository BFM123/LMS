<?php	
	function submit(){
		global $APPROVAL_STATUS;
		
		// NGO details
		$organization_id = isset($_POST["organization_id"]) ? $_POST["organization_id"] : "";
		$organization_name = isset($_POST["organization_name"]) ? $_POST["organization_name"] : "";
		$abbreviation = isset($_POST["abbreviation"]) ? $_POST["abbreviation"] : "";
		$charity_number = isset($_POST["charity_number"]) ? $_POST["charity_number"] : "";
		$telephone = isset($_POST["telephone"]) ? $_POST["telephone"] : "";
		$email = isset($_POST["email"]) ? $_POST["email"] : "";
		$organization_type = isset($_POST["organization_type"]) ? $_POST["organization_type"] : "";
		$registration_type = isset($_POST["registration_type"]) ? $_POST["registration_type"] : "";
		$postal_address = isset($_POST["postal_address"]) ? $_POST["postal_address"] : "";
		$district_id = isset($_POST["district_id"]) ? $_POST["district_id"] : "";
		$physical_address = isset($_POST["physical_address"]) ? $_POST["physical_address"] : "";
		$objectives = isset($_POST["objectives"]) ? $_POST["objectives"] : array();
		$staff_capacity_type = isset($_POST["staff_capacity_type"]) ? $_POST["staff_capacity_type"] : array();
		$staff_capacity_numbers = isset($_POST["staff_capacity_number"]) ? $_POST["staff_capacity_number"] : array();
		foreach($staff_capacity_numbers as $key => $value) :
			 $staff_capacity_numbers[$key] = str_replace(",", "", $value);  // remove commas
		endforeach;
		$staff_capacity_number = $staff_capacity_numbers;
			
		// coverage
		$sectors = isset($_POST["sectors"]) ? $_POST["sectors"] : array();
		$location_activities_vdc = isset($_POST["location_activities_vdc"]) ? $_POST["location_activities_vdc"] : array();
		$location_activities_adc = isset($_POST["location_activities_adc"]) ? $_POST["location_activities_adc"] : array();
		$location_activities_district_id = isset($_POST["location_activities_district_id"]) ? $_POST["location_activities_district_id"] : array();
		$target_groups = isset($_POST["target_groups"]) ? $_POST["target_groups"] : array();
		
		// governance
		$executive_director_fullname = isset($_POST["executive_director_fullname"]) ? $_POST["executive_director_fullname"] : "";
		$executive_director_nationality = isset($_POST["executive_director_nationality"]) ? $_POST["executive_director_nationality"] : "";
		$executive_director_national_id = isset($_POST["executive_director_national_id"]) ? $_POST["executive_director_national_id"] : "";
		$executive_director_highest_qualification = isset($_POST["executive_director_highest_qualification"]) ? $_POST["executive_director_highest_qualification"] : "";
		$executive_director_email = isset($_POST["executive_director_email"]) ? $_POST["executive_director_email"] : "";
		$executive_director_telephone = isset($_POST["executive_director_telephone"]) ? $_POST["executive_director_telephone"] : "";
		$directors_trustees_fullname = isset($_POST["directors_trustees_fullname"]) ? $_POST["directors_trustees_fullname"] : array();
		$directors_trustees_telephone = isset($_POST["directors_trustees_telephone"]) ? $_POST["directors_trustees_telephone"] : array();
		$directors_trustees_email = isset($_POST["directors_trustees_email"]) ? $_POST["directors_trustees_email"] : array();
		$directors_trustees_occupation = isset($_POST["directors_trustees_occupation"]) ? $_POST["directors_trustees_occupation"] : array();
		$directors_trustees_nationality = isset($_POST["directors_trustees_nationality"]) ? $_POST["directors_trustees_nationality"] : array();
		$directors_trustees_national_id = isset($_POST["directors_trustees_national_id"]) ? $_POST["directors_trustees_national_id"] : array();
		$directors_trustees_position = isset($_POST["directors_trustees_position"]) ? $_POST["directors_trustees_position"] : array();
		$directors_trustees_timeframe = isset($_POST["directors_trustees_timeframe"]) ? $_POST["directors_trustees_timeframe"] : array();

		// accounting
		$financial_year_start_month = isset($_POST["financial_year_start_month"]) ? $_POST["financial_year_start_month"] : "";
		$financial_year_end_month = isset($_POST["financial_year_end_m"]) ? $_POST["financial_year_end_m"] : "";
		$annual_income = isset($_POST["annual_income"]) ? $_POST["annual_income"] : "";
		$annual_income = str_replace(",", "", $annual_income); // remove commas
		$source_funding_donor_id = isset($_POST["source_funding_donor_id"]) ? $_POST["source_funding_donor_id"] : array();
		$source_funding_contact_details = isset($_POST["source_funding_contact_details"]) ? $_POST["source_funding_contact_details"] : array();
		$source_funding_currency = isset($_POST["source_funding_currency"]) ? $_POST["source_funding_currency"] : array();
		$source_funding_amounts = isset($_POST["source_funding_amount"]) ? $_POST["source_funding_amount"] : array();
		foreach($source_funding_amounts as $key => $value) :
			 $source_funding_amounts[$key] = str_replace(",", "", $value);  // remove commas
		endforeach;
		$source_funding_amount = $source_funding_amounts;
		$auditor_name = isset($_POST["auditor_name"]) ? $_POST["auditor_name"] : array();
		$auditor_address = isset($_POST["auditor_address"]) ? $_POST["auditor_address"] : array();
		$auditor_telephone = isset($_POST["auditor_telephone"]) ? $_POST["auditor_telephone"] : array();
		$auditor_email = isset($_POST["auditor_email"]) ? $_POST["auditor_email"] : array();
		$bank_id = isset($_POST["bank_id"]) ? $_POST["bank_id"] : array();
		$bank_address = isset($_POST["bank_address"]) ? $_POST["bank_address"] : array();
		$bank_telephone = isset($_POST["bank_telephone"]) ? $_POST["bank_telephone"] : array();
		$bank_email = isset($_POST["bank_email"]) ? $_POST["bank_email"] : array();

		// temporary employment permit
		$tep_fullname = isset($_POST["tep_fullname"]) ? $_POST["tep_fullname"] : array();
		$tep_nationality = isset($_POST["tep_nationality"]) ? $_POST["tep_nationality"] : array();
		$tep_passport_number = isset($_POST["tep_passport_number"]) ? $_POST["tep_passport_number"] : array();

		// documents
		$license_payment_proof = isset($_FILES["license_payment_proof"]) ? $_FILES["license_payment_proof"] : array();
		$annual_technical_report = isset($_FILES["annual_technical_report"]) ? $_FILES["annual_technical_report"] : array();
		$financial_statement = isset($_FILES["financial_statement"]) ? $_FILES["financial_statement"] : array();
		$documents = array(
						DOCUMENT_CATEGORY_PAYMENT_PROOF_LICENSE => $license_payment_proof, DOCUMENT_CATEGORY_TECHNICAL_REPORT => $annual_technical_report, 
					 	DOCUMENT_CATEGORY_FINANCIAL_STATEMENT => $financial_statement					
					);
		$additional_documents = isset($_FILES["additional_documents"]) ? $_FILES["additional_documents"] : array();
		
		foreach($additional_documents AS $key => $additional_document) :
			if ($key === "name") {
				foreach($additional_document AS $d => $additional_doc) :
					$i = $d + 1;
					$documents[DOCUMENT_CATEGORY_ADDITIONAL_DOCUMENT . " " . $i] = array(
							"name" => $additional_doc, 
							"type" => $additional_documents["type"][$d], 
							"tmp_name" => $additional_documents["tmp_name"][$d], 
							"error" => $additional_documents["error"][$d], 
							"size" => $additional_documents["size"][$d]);
				endforeach;
			}
		endforeach;

		// other
		$action = isset($_POST["option"]) ? $_POST["option"] : "";
		$user_action = "submit";
		$record_control = array_keys($APPROVAL_STATUS)[1];
		if (isset($_POST["draft"])) {
			$record_control = array_keys($APPROVAL_STATUS)[0];
			$user_action = "update";
		}
		
		$captured_by = isset($_POST["last_edited_by"]) ? $_POST["last_edited_by"] : "";

		$licensing_organization = new licensing_organization();
		// NGO details
		$licensing_organization->setOrganizationID($organization_id);
		$licensing_organization->setOrganizationName($organization_name);
		$licensing_organization->setAbbreviation($abbreviation);
		$licensing_organization->setCharityNumber($charity_number);
		$licensing_organization->setTelephone($telephone);
		$licensing_organization->setEmail($email);
		$licensing_organization->setOrganizationType($organization_type);
		$licensing_organization->setRegistrationType($registration_type);
		$licensing_organization->setPostalAddress($postal_address);
		$licensing_organization->setDistrictID($district_id);
		$licensing_organization->setPhysicalAddress($physical_address);
		$licensing_organization->setObjectives($objectives);
		$licensing_organization->setStaffCapacityType($staff_capacity_type);
		$licensing_organization->setStaffCapacityNumber($staff_capacity_number);
		
		// coverage
		$licensing_organization->setSectors($sectors);
		$licensing_organization->setLocationActivitiesVDC($location_activities_vdc);
		$licensing_organization->setLocationActivitiesADC($location_activities_adc);
		$licensing_organization->setLocationActivitiesDistrictID($location_activities_district_id);
		$licensing_organization->setTargetGroups($target_groups);
		
		// governance
		$licensing_organization->setExecutiveDirectorFullname($executive_director_fullname);
		$licensing_organization->setExecutiveDirectorNationality($executive_director_nationality);
		$licensing_organization->setExecutiveDirectorNationalID($executive_director_national_id);
		$licensing_organization->setExecutiveDirectorHighestQualification($executive_director_highest_qualification);
		$licensing_organization->setExecutiveDirectorEmail($executive_director_email);
		$licensing_organization->setExecutiveDirectorTelephone($executive_director_telephone);
		$licensing_organization->setDirectorsTrusteesFullname($directors_trustees_fullname);
		$licensing_organization->setDirectorsTrusteesTelephone($directors_trustees_telephone);
		$licensing_organization->setDirectorsTrusteesEmail($directors_trustees_email);
		$licensing_organization->setDirectorsTrusteesOccupation($directors_trustees_occupation);
		$licensing_organization->setDirectorsTrusteesNationality($directors_trustees_nationality);
		$licensing_organization->setDirectorsTrusteesNationalID($directors_trustees_national_id);
		$licensing_organization->setDirectorsTrusteesPosition($directors_trustees_position);
		$licensing_organization->setDirectorsTrusteesTimeframe($directors_trustees_timeframe);
		
		// accounting
		$licensing_organization->setFinancialYearStartMonth($financial_year_start_month);
		$licensing_organization->setFinancialYearEndMonth($financial_year_end_month);
		$licensing_organization->setAnnualIncome($annual_income);
		$licensing_organization->setSourceFundingDonorID($source_funding_donor_id);
		$licensing_organization->setSourceFundingContactDetails($source_funding_contact_details);
		$licensing_organization->setSourceFundingCurrency($source_funding_currency);
		$licensing_organization->setSourceFundingAmount($source_funding_amount);
		$licensing_organization->setAuditorName($auditor_name);
		$licensing_organization->setAuditorAddress($auditor_address);
		$licensing_organization->setAuditorTelephone($auditor_telephone);
		$licensing_organization->setAuditorEmail($auditor_email);
		$licensing_organization->setBankID($bank_id);
		$licensing_organization->setBankAddress($bank_address);
		$licensing_organization->setBankTelephone($bank_telephone);
		$licensing_organization->setBankEmail($bank_email);
		
		// temporary employment permit
		$licensing_organization->setTEPFullname($tep_fullname);
		$licensing_organization->setTEPNationality($tep_nationality);
		$licensing_organization->setTEPPassportNumber($tep_passport_number);

		// documents
		$licensing_organization->setDocuments($documents);
		
		// other		
		$licensing_organization->setRecordControl($record_control);
		$licensing_organization->setCapturedBy($captured_by);
		$licensing_organization->setAction($action);
		$licensing_organization->setUserAction($user_action);

		if ($action === "edit") {
			$licensing_organization_id  = isset($_POST["licensing_organization_id"]) ? $_POST["licensing_organization_id"] : "";
			$reporting_year  = isset($_POST["reporting_year"]) ? $_POST["reporting_year"] : "";
			$objectives_id = isset($_POST["objectives_id"]) ? $_POST["objectives_id"] : array();
			$staff_capacity_id = isset($_POST["staff_capacity_id"]) ? $_POST["staff_capacity_id"] : array();			 
			$sector_id = isset($_POST["sector_id"]) ? $_POST["sector_id"] : array();
			$location_activities_id = isset($_POST["location_activities_id"]) ? $_POST["location_activities_id"] : array();			 
			$target_group_id = isset($_POST["target_group_id"]) ? $_POST["target_group_id"] : array();			 
			$directors_trustees_id = isset($_POST["directors_trustees_id"]) ? $_POST["directors_trustees_id"] : array();			 			
			$source_funding_id = isset($_POST["source_funding_id"]) ? $_POST["source_funding_id"] : array();			 
			$auditor_id = isset($_POST["auditor_id"]) ? $_POST["auditor_id"] : array();			 
			$organization_bank_id = isset($_POST["organization_bank_id"]) ? $_POST["organization_bank_id"] : array();			 
			$tep_id = isset($_POST["tep_id"]) ? $_POST["tep_id"] : array();			 
			$license_payment_proof_id =  isset($_POST["license_payment_proof_id"]) ? $_POST["license_payment_proof_id"] : array();
			$annual_technical_report_id =  isset($_POST["annual_technical_report_id"]) ? $_POST["annual_technical_report_id"] : array();
			$financial_statement_id =  isset($_POST["financial_statement_id"]) ? $_POST["financial_statement_id"] : array();
			$documents_id = array(
						DOCUMENT_CATEGORY_PAYMENT_PROOF_LICENSE => $license_payment_proof_id, DOCUMENT_CATEGORY_TECHNICAL_REPORT => $annual_technical_report_id, 
						DOCUMENT_CATEGORY_FINANCIAL_STATEMENT => $financial_statement_id);
			$additional_documents_id = isset($_POST["additional_documents_id"]) ? $_POST["additional_documents_id"] : array();
			
			foreach($additional_documents_id AS $key => $additional_document_id) :
				$i = $key + 1;
				$documents_id[DOCUMENT_CATEGORY_ADDITIONAL_DOCUMENT . " " . $i] = $additional_document_id;
			endforeach;
			
			$last_edited_by = isset($_POST["last_edited_by"]) ? $_POST["last_edited_by"] : "";
			$record_control = common::getFieldValue("licensing_organization", "record_control", "licensing_organization_id", $licensing_organization_id, "organization_id",
													$organization_id);			
			if ($record_control == array_keys($APPROVAL_STATUS)[0])
				$organization_name = isset($_POST["organization_name"]) ? $_POST["organization_name"] : "";
			else
				$organization_name = common::getFieldValue("organization", "organization_name", "organization_id", $organization_id);
			
			$licensing_organization->setLicensingOrganizationID($licensing_organization_id);
			$licensing_organization->setObjectiveID($objectives_id);
			$licensing_organization->setStaffCapacityID($staff_capacity_id);			
			$licensing_organization->setSectorID($sector_id);			 
			$licensing_organization->setLocationActivityID($location_activities_id);			 
			$licensing_organization->setTargetGroupID($target_group_id);			 
			$licensing_organization->setTrusteeID($directors_trustees_id);			 			
			$licensing_organization->setSourceFundingID($source_funding_id);			 
			$licensing_organization->setAuditorID($auditor_id);			 
			$licensing_organization->setOrganizationBankID($organization_bank_id);
			$licensing_organization->setTEPID($tep_id);
			$licensing_organization->setDocumentID($documents_id);
			$licensing_organization->setRecordControl($record_control);
			$licensing_organization->setReportingYear($reporting_year);
			$licensing_organization->setOrganizationName($organization_name);
			$licensing_organization->setLastEditedBy($last_edited_by);
			
			$licensing_organization->edit();
		} else {
			$licensing_organization->submit();
		}
	}

	function edit(){
		submit();
	}
	
	function approve(){		
		$organization_id = isset($_POST["organization_id"]) ? $_POST["organization_id"] : "";
		$licensing_organization_id = isset($_POST["licensing_organization_id"]) ? $_POST["licensing_organization_id"] : "";
		$organization_name = common::getFieldValue("organization", "organization_name", "organization_id", $organization_id);
		$approved_by = isset($_POST["approved_by"]) ? $_POST["approved_by"] : "";
		$record_control = isset($_POST["record_control"]) ? $_POST["record_control"] : "";
		$reporting_year = isset($_POST["reporting_year"]) ? $_POST["reporting_year"] : "";
		$rejected_comments = isset($_POST["rejected_comments"]) ? $_POST["rejected_comments"] : "";
		$action = isset($_POST["option"]) ? $_POST["option"] : "";
		
		$licensing_organization = new licensing_organization();		
		$licensing_organization->setOrganizationID($organization_id);	
		$licensing_organization->setLicensingOrganizationID($licensing_organization_id);	
		$licensing_organization->setOrganizationName($organization_name);	
		$licensing_organization->setApprovedBy($approved_by);	
		$licensing_organization->setRejectedComments($rejected_comments);
		$licensing_organization->setReportingYear($reporting_year);
		$licensing_organization->setRecordControl($record_control);
		$licensing_organization->setAction($action);
		
		$licensing_organization->approve();			
	}
	
	function reject(){
		approve();
	}
	
	function delete() {
		$organization_id = isset($_POST["organization_id"]) ? $_POST["organization_id"] : "";
		$licensing_organization_id = isset($_POST["licensing_organization_id"]) ? $_POST["licensing_organization_id"] : "";
		$reporting_year = isset($_POST["reporting_year"]) ? $_POST["reporting_year"] : "";
        $organization_name = isset($_POST["organization_name"]) ? $_POST["organization_name"] : "";
        $deleted_by = isset($_POST["deleted_by"]) ? $_POST["deleted_by"] : "";

		$licensing_organization = new licensing_organization();
		$licensing_organization->setOrganizationID($organization_id);
		$licensing_organization->setLicensingOrganizationID($licensing_organization_id);	
		$licensing_organization->setReportingYear($reporting_year);
        $licensing_organization->setOrganizationName($organization_name);
		$licensing_organization->setDeletedBy($deleted_by);

		$licensing_organization->delete();
	}
?>
