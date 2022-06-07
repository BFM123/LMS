<?php
require_once "common.php";
require_once "user.php";
require_once "certificate.php";
require_once "fee.php";
require_once "invoice.php";
require_once "send_email.php";

/**
 * licensing_organization class
 */
class licensing_organization
{
   /**
	* declarations 
	*/
    private $licensing_organization_id;
    private $organization_id;
    private $organization_name;
    private $abbreviation;
    private $charity_number;
    private $telephone;
    private $email;
    private $organization_type;
    private $registration_type;
    private $postal_address;
    private $district_id;
    private $physical_address;
    private $objective_id;
    private $objectives;
    private $staff_capacity_id;
    private $staff_capacity_type;
    private $staff_capacity_number;
    private $sector_id;
    private $sectors;
    private $location_activity_id;
    private $location_activities_vdc;
    private $location_activities_adc;
    private $location_activities_district_id;
    private $target_group_id;
    private $target_groups;
    private $executive_director_fullname;
    private $executive_director_nationality;
    private $executive_director_national_id;
    private $executive_director_highest_qualification;
    private $executive_director_email;
    private $executive_director_telephone;
    private $trustee_id;
    private $directors_trustees_fullname;
    private $directors_trustees_telephone;
    private $directors_trustees_email;
    private $directors_trustees_occupation;
    private $directors_trustees_nationality;
    private $directors_trustees_national_id;
    private $directors_trustees_position;
    private $directors_trustees_timeframe;
    private $financial_year_start_month;
    private $financial_year_end_month;
    private $annual_income;
    private $source_funding_id;
    private $source_funding_donor_id;
    private $source_funding_contact_details;
    private $source_funding_currency;
    private $source_funding_amount;
    private $auditor_id;
    private $auditor_name;
    private $auditor_address;
    private $auditor_telephone;
    private $auditor_email;
    private $organization_bank_id;
    private $bank_id;
    private $bank_address;
    private $bank_telephone;
    private $bank_email;
	private $tep_id;
    private $tep_fullname;
    private $tep_nationality;
    private $tep_passport_number;
    private $document_id;
    private $documents;
    private $record_control;
    private $reporting_year;
    private $captured_by;
    private $action;
    private $user_action;
    private $last_edited_by;
    private $approved_by;
    private $rejected_comments;
    private $deleted_by;
    private $status;

    /**
     * Get the value of licensing_organization_id
     *
     * @return mixed
     */
    public function getLicensingOrganizationID()
    {
        return $this->licensing_organization_id;
    }
 
    /**
     * Set the value of licensing_organization_id
     *
     * @param mixed licensing_organization_id
     *
     * @return self
     */
    public function setLicensingOrganizationID($licensing_organization_id)
    {
        $this->licensing_organization_id = $licensing_organization_id;

        return $this;
    }
 
    /**
     * Get the value of organization_id
     *
     * @return mixed
     */
    public function getOrganizationID()
    {
        return $this->organization_id;
    }
 
    /**
     * Set the value of organization_id
     *
     * @param mixed organization_id
     *
     * @return self
     */
    public function setOrganizationID($organization_id)
    {
        $this->organization_id = $organization_id;

        return $this;
    }
 
    /**
     * Get the value of organization_name
     *
     * @return mixed
     */
    public function getOrganizationName()
    {
        return $this->organization_name;
    }
 
    /**
     * Set the value of organization_name
     *
     * @param mixed organization_name
     *
     * @return self
     */
    public function setOrganizationName($organization_name)
    {
        $this->organization_name = $organization_name;

        return $this;
    }
 
    /**
     * Get the value of abbreviation
     *
     * @return mixed
     */
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }
 
    /**
     * Set the value of abbreviation
     *
     * @param mixed abbreviation
     *
     * @return self
     */
    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }
 
    /**
     * Get the value of charity_number
     *
     * @return mixed
     */
    public function getCharityNumber()
    {
        return $this->charity_number;
    }
 
    /**
     * Set the value of charity_number
     *
     * @param mixed charity_number
     *
     * @return self
     */
    public function setCharityNumber($charity_number)
    {
        $this->charity_number = $charity_number;

        return $this;
    }
 
    /**
     * Get the value of telephone
     *
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
 
    /**
     * Set the value of telephone
     *
     * @param mixed telephone
     *
     * @return self
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }
 
    /**
     * Get the value of email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
 
    /**
     * Set the value of email
     *
     * @param mixed email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
 
    /**
     * Get the value of organization_type
     *
     * @return mixed
     */
    public function getOrganizationType()
    {
        return $this->organization_type;
    }
 
    /**
     * Set the value of organization_type
     *
     * @param mixed organization_type
     *
     * @return self
     */
    public function setOrganizationType($organization_type)
    {
        $this->organization_type = $organization_type;

        return $this;
    }
 
    /**
     * Get the value of registration_type
     *
     * @return mixed
     */
    public function getRegistrationType()
    {
        return $this->registration_type;
    }
 
    /**
     * Set the value of registration_type
     *
     * @param mixed registration_type
     *
     * @return self
     */
    public function setRegistrationType($registration_type)
    {
        $this->registration_type = $registration_type;

        return $this;
    }
 
    /**
     * Get the value of postal_address
     *
     * @return mixed
     */
    public function getPostalAddress()
    {
        return $this->postal_address;
    }
 
    /**
     * Set the value of postal_address
     *
     * @param mixed postal_address
     *
     * @return self
     */
    public function setPostalAddress($postal_address)
    {
        $this->postal_address = $postal_address;

        return $this;
    }
 
    /**
     * Get the value of district_id
     *
     * @return mixed
     */
    public function getDistrictID()
    {
        return $this->district_id;
    }
 
    /**
     * Set the value of district_id
     *
     * @param mixed district_id
     *
     * @return self
     */
    public function setDistrictID($district_id)
    {
        $this->district_id = $district_id;

        return $this;
    }
 
    /**
     * Get the value of physical_address
     *
     * @return mixed
     */
    public function getPhysicalAddress()
    {
        return $this->physical_address;
    }
 
    /**
     * Set the value of physical_address
     *
     * @param mixed physical_address
     *
     * @return self
     */
    public function setPhysicalAddress($physical_address)
    {
        $this->physical_address = $physical_address;

        return $this;
    }
 
    /**
     * Get the value of objective_id
     *
     * @return mixed
     */
    public function getObjectiveID()
    {
        return $this->objective_id;
    }
 
    /**
     * Set the value of objective_id
     *
     * @param mixed objective_id
     *
     * @return self
     */
    public function setObjectiveID($objective_id)
    {
        $this->objective_id = $objective_id;

        return $this;
    }
 
    /**
     * Get the value of objectives
     *
     * @return mixed
     */
    public function getObjectives()
    {
        return $this->objectives;
    }
 
    /**
     * Set the value of objectives
     *
     * @param mixed objectives
     *
     * @return self
     */
    public function setObjectives($objectives)
    {
        $this->objectives = $objectives;

        return $this;
    }
 
    /**
     * Get the value of staff_capacity_id
     *
     * @return mixed
     */
    public function getStaffCapacityID()
    {
        return $this->staff_capacity_id;
    }
 
    /**
     * Set the value of staff_capacity_id
     *
     * @param mixed staff_capacity_id
     *
     * @return self
     */
    public function setStaffCapacityID($staff_capacity_id)
    {
        $this->staff_capacity_id = $staff_capacity_id;

        return $this;
    }
 
    /**
     * Get the value of staff_capacity_type
     *
     * @return mixed
     */
    public function getStaffCapacityType()
    {
        return $this->staff_capacity_type;
    }
 
    /**
     * Set the value of staff_capacity_type
     *
     * @param mixed staff_capacity_type
     *
     * @return self
     */
    public function setStaffCapacityType($staff_capacity_type)
    {
        $this->staff_capacity_type = $staff_capacity_type;

        return $this;
    }
 
    /**
     * Get the value of staff_capacity_number
     *
     * @return mixed
     */
    public function getStaffCapacityNumber()
    {
        return $this->staff_capacity_number;
    }
 
    /**
     * Set the value of staff_capacity_number
     *
     * @param mixed staff_capacity_number
     *
     * @return self
     */
    public function setStaffCapacityNumber($staff_capacity_number)
    {
        $this->staff_capacity_number = $staff_capacity_number;

        return $this;
    }
  
    /**
     * Get the value of sector_id
     *
     * @return mixed
     */
    public function getSectorID()
    {
        return $this->sector_id;
    }
 
    /**
     * Set the value of sector_id
     *
     * @param mixed sector_id
     *
     * @return self
     */
    public function setSectorID($sector_id)
    {
        $this->sector_id = $sector_id;

        return $this;
    }
	
    /**
     * Get the value of sectors
     *
     * @return mixed
     */
    public function getSectors()
    {
        return $this->sectors;
    }
 
    /**
     * Set the value of sectors
     *
     * @param mixed sectors
     *
     * @return self
     */
    public function setSectors($sectors)
    {
        $this->sectors = $sectors;

        return $this;
    }
 
    /**
     * Get the value of location_activity_id
     *
     * @return mixed
     */
    public function getLocationActivityID()
    {
        return $this->location_activity_id;
    }
 
    /**
     * Set the value of location_activity_id
     *
     * @param mixed location_activity_id
     *
     * @return self
     */
    public function setLocationActivityID($location_activity_id)
    {
        $this->location_activity_id = $location_activity_id;

        return $this;
    }
	
    /**
     * Get the value of location_activities_vdc
     *
     * @return mixed
     */
    public function getLocationActivitiesVDC()
    {
        return $this->location_activities_vdc;
    }
 
    /**
     * Set the value of location_activities_vdc
     *
     * @param mixed location_activities_vdc
     *
     * @return self
     */
    public function setLocationActivitiesVDC($location_activities_vdc)
    {
        $this->location_activities_vdc = $location_activities_vdc;

        return $this;
    }
 
    /**
     * Get the value of location_activities_adc
     *
     * @return mixed
     */
    public function getLocationActivitiesADC()
    {
        return $this->location_activities_adc;
    }
 
    /**
     * Set the value of location_activities_adc
     *
     * @param mixed location_activities_adc
     *
     * @return self
     */
    public function setLocationActivitiesADC($location_activities_adc)
    {
        $this->location_activities_adc = $location_activities_adc;

        return $this;
    }
 
    /**
     * Get the value of location_activities_district_id
     *
     * @return mixed
     */
    public function getLocationActivitiesDistrictID()
    {
        return $this->location_activities_district_id;
    }
 
    /**
     * Set the value of location_activities_district_id
     *
     * @param mixed location_activities_district_id
     *
     * @return self
     */
    public function setLocationActivitiesDistrictID($location_activities_district_id)
    {
        $this->location_activities_district_id = $location_activities_district_id;

        return $this;
    }
 
    /**
     * Get the value of target_group_id
     *
     * @return mixed
     */
    public function getTargetGroupID()
    {
        return $this->target_group_id;
    }
 
    /**
     * Set the value of target_group_id
     *
     * @param mixed target_group_id
     *
     * @return self
     */
    public function setTargetGroupID($target_group_id)
    {
        $this->target_group_id = $target_group_id;

        return $this;
    }
	
    /**
     * Get the value of target_groups
     *
     * @return mixed
     */
    public function getTargetGroups()
    {
        return $this->target_groups;
    }
 
    /**
     * Set the value of target_groups
     *
     * @param mixed target_groups
     *
     * @return self
     */
    public function setTargetGroups($target_groups)
    {
        $this->target_groups = $target_groups;

        return $this;
    }
 
    /**
     * Get the value of executive_director_fullname
     *
     * @return mixed
     */
    public function getExecutiveDirectorFullname()
    {
        return $this->executive_director_fullname;
    }
 
    /**
     * Set the value of executive_director_fullname
     *
     * @param mixed executive_director_fullname
     *
     * @return self
     */
    public function setExecutiveDirectorFullname($executive_director_fullname)
    {
        $this->executive_director_fullname = $executive_director_fullname;

        return $this;
    }
 
    /**
     * Get the value of executive_director_nationality
     *
     * @return mixed
     */
    public function getExecutiveDirectorNationality()
    {
        return $this->executive_director_nationality;
    }
 
    /**
     * Set the value of executive_director_nationality
     *
     * @param mixed executive_director_nationality
     *
     * @return self
     */
    public function setExecutiveDirectorNationality($executive_director_nationality)
    {
        $this->executive_director_nationality = $executive_director_nationality;

        return $this;
    }
 
 	/**
     * Get the value of executive_director_national_id
     *
     * @return mixed
     */
    public function getExecutiveDirectorNationalID()
    {
        return $this->executive_director_national_id;
    }
 
    /**
     * Set the value of executive_director_national_id
     *
     * @param mixed executive_director_national_id
     *
     * @return self
     */
    public function setExecutiveDirectorNationalID($executive_director_national_id)
    {
        $this->executive_director_national_id = $executive_director_national_id;

        return $this;
    }

    /**
     * Get the value of executive_director_highest_qualification
     *
     * @return mixed
     */
    public function getExecutiveDirectorHighestQualification()
    {
        return $this->executive_director_highest_qualification;
    }
 
    /**
     * Set the value of executive_director_highest_qualification
     *
     * @param mixed executive_director_highest_qualification
     *
     * @return self
     */
    public function setExecutiveDirectorHighestQualification($executive_director_highest_qualification)
    {
        $this->executive_director_highest_qualification = $executive_director_highest_qualification;

        return $this;
    }
 
    /**
     * Get the value of executive_director_email
     *
     * @return mixed
     */
    public function getExecutiveDirectorEmail()
    {
        return $this->executive_director_email;
    }
 
    /**
     * Set the value of executive_director_email
     *
     * @param mixed executive_director_email
     *
     * @return self
     */
    public function setExecutiveDirectorEmail($executive_director_email)
    {
        $this->executive_director_email = $executive_director_email;

        return $this;
    }
 
    /**
     * Get the value of executive_director_telephone
     *
     * @return mixed
     */
    public function getExecutiveDirectorTelephone()
    {
        return $this->executive_director_telephone;
    }
 
    /**
     * Set the value of executive_director_telephone
     *
     * @param mixed executive_director_telephone
     *
     * @return self
     */
    public function setExecutiveDirectorTelephone($executive_director_telephone)
    {
        $this->executive_director_telephone = $executive_director_telephone;

        return $this;
    }
	
	/**
     * Get the value of trustee_id
     *
     * @return mixed
     */
    public function getTrusteeID()
    {
        return $this->trustee_id;
    }
 
    /**
     * Set the value of trustee_id
     *
     * @param mixed trustee_id
     *
     * @return self
     */
    public function setTrusteeID($trustee_id)
    {
        $this->trustee_id = $trustee_id;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_fullname
     *
     * @return mixed
     */
    public function getDirectorsTrusteesFullname()
    {
        return $this->directors_trustees_fullname;
    }
 
    /**
     * Set the value of directors_trustees_fullname
     *
     * @param mixed directors_trustees_fullname
     *
     * @return self
     */
    public function setDirectorsTrusteesFullname($directors_trustees_fullname)
    {
        $this->directors_trustees_fullname = $directors_trustees_fullname;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_telephone
     *
     * @return mixed
     */
    public function getDirectorsTrusteesTelephone()
    {
        return $this->directors_trustees_telephone;
    }
 
    /**
     * Set the value of directors_trustees_telephone
     *
     * @param mixed directors_trustees_telephone
     *
     * @return self
     */
    public function setDirectorsTrusteesTelephone($directors_trustees_telephone)
    {
        $this->directors_trustees_telephone = $directors_trustees_telephone;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_email
     *
     * @return mixed
     */
    public function getDirectorsTrusteesEmail()
    {
        return $this->directors_trustees_email;
    }
 
    /**
     * Set the value of directors_trustees_email
     *
     * @param mixed directors_trustees_email
     *
     * @return self
     */
    public function setDirectorsTrusteesEmail($directors_trustees_email)
    {
        $this->directors_trustees_email = $directors_trustees_email;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_occupation
     *
     * @return mixed
     */
    public function getDirectorsTrusteesOccupation()
    {
        return $this->directors_trustees_occupation;
    }
 
    /**
     * Set the value of directors_trustees_occupation
     *
     * @param mixed directors_trustees_occupation
     *
     * @return self
     */
    public function setDirectorsTrusteesOccupation($directors_trustees_occupation)
    {
        $this->directors_trustees_occupation = $directors_trustees_occupation;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_nationality
     *
     * @return mixed
     */
    public function getDirectorsTrusteesNationality()
    {
        return $this->directors_trustees_nationality;
    }
 
    /**
     * Set the value of directors_trustees_nationality
     *
     * @param mixed directors_trustees_nationality
     *
     * @return self
     */
    public function setDirectorsTrusteesNationality($directors_trustees_nationality)
    {
        $this->directors_trustees_nationality = $directors_trustees_nationality;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_national_id
     *
     * @return mixed
     */
    public function getDirectorsTrusteesNationalID()
    {
        return $this->directors_trustees_national_id;
    }
 
    /**
     * Set the value of directors_trustees_national_id
     *
     * @param mixed directors_trustees_national_id
     *
     * @return self
     */
    public function setDirectorsTrusteesNationalID($directors_trustees_national_id)
    {
        $this->directors_trustees_national_id = $directors_trustees_national_id;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_position
     *
     * @return mixed
     */
    public function getDirectorsTrusteesPosition()
    {
        return $this->directors_trustees_position;
    }
 
    /**
     * Set the value of directors_trustees_position
     *
     * @param mixed directors_trustees_position
     *
     * @return self
     */
    public function setDirectorsTrusteesPosition($directors_trustees_position)
    {
        $this->directors_trustees_position = $directors_trustees_position;

        return $this;
    }
 
    /**
     * Get the value of directors_trustees_timeframe
     *
     * @return mixed
     */
    public function getDirectorsTrusteesTimeframe()
    {
        return $this->directors_trustees_timeframe;
    }
 
    /**
     * Set the value of directors_trustees_timeframe
     *
     * @param mixed directors_trustees_timeframe
     *
     * @return self
     */
    public function setDirectorsTrusteesTimeframe($directors_trustees_timeframe)
    {
        $this->directors_trustees_timeframe = $directors_trustees_timeframe;

        return $this;
    }
 
    /**
     * Get the value of financial_year_start_month
     *
     * @return mixed
     */
    public function getFinancialYearStartMonth()
    {
        return $this->financial_year_start_month;
    }
 
    /**
     * Set the value of financial_year_start_month
     *
     * @param mixed financial_year_start_month
     *
     * @return self
     */
    public function setFinancialYearStartMonth($financial_year_start_month)
    {
        $this->financial_year_start_month = $financial_year_start_month;

        return $this;
    }
 
    /**
     * Get the value of financial_year_end_month
     *
     * @return mixed
     */
    public function getFinancialYearEndMonth()
    {
        return $this->financial_year_end_month;
    }
 
    /**
     * Set the value of financial_year_end_month
     *
     * @param mixed financial_year_end_month
     *
     * @return self
     */
    public function setFinancialYearEndMonth($financial_year_end_month)
    {
        $this->financial_year_end_month = $financial_year_end_month;

        return $this;
    }

    /**
     * Get the value of annual_income
     *
     * @return mixed
     */
    public function getAnnualIncome()
    {
        return $this->annual_income;
    }
 
    /**
     * Set the value of annual_income
     *
     * @param mixed annual_income
     *
     * @return self
     */
    public function setAnnualIncome($annual_income)
    {
        $this->annual_income = $annual_income;

        return $this;
    }

    /**
     * Get the value of source_funding_id
     *
     * @return mixed
     */
    public function getSourceFundingID()
    {
        return $this->source_funding_id;
    }
 
    /**
     * Set the value of source_funding_id
     *
     * @param mixed source_funding_id
     *
     * @return self
     */
    public function setSourceFundingID($source_funding_id)
    {
        $this->source_funding_id = $source_funding_id;

        return $this;
    }
 
    /**
     * Get the value of source_funding_donor_id
     *
     * @return mixed
     */
    public function getSourceFundingDonorID()
    {
        return $this->source_funding_donor_id;
    }
 
    /**
     * Set the value of source_funding_donor_id
     *
     * @param mixed source_funding_donor_id
     *
     * @return self
     */
    public function setSourceFundingDonorID($source_funding_donor_id)
    {
        $this->source_funding_donor_id = $source_funding_donor_id;

        return $this;
    }
 
    /**
     * Get the value of source_funding_contact_details
     *
     * @return mixed
     */
    public function getSourceFundingContactDetails()
    {
        return $this->source_funding_contact_details;
    }
 
    /**
     * Set the value of source_funding_contact_details
     *
     * @param mixed source_funding_contact_details
     *
     * @return self
     */
    public function setSourceFundingContactDetails($source_funding_contact_details)
    {
        $this->source_funding_contact_details = $source_funding_contact_details;

        return $this;
    }
 
    /**
     * Get the value of source_funding_currency
     *
     * @return mixed
     */
    public function getSourceFundingCurrency()
    {
        return $this->source_funding_currency;
    }
 
    /**
     * Set the value of source_funding_currency
     *
     * @param mixed source_funding_currency
     *
     * @return self
     */
    public function setSourceFundingCurrency($source_funding_currency)
    {
        $this->source_funding_currency = $source_funding_currency;

        return $this;
    }
 
    /**
     * Get the value of source_funding_amount
     *
     * @return mixed
     */
    public function getSourceFundingAmount()
    {
        return $this->source_funding_amount;
    }
 
    /**
     * Set the value of source_funding_amount
     *
     * @param mixed source_funding_amount
     *
     * @return self
     */
    public function setSourceFundingAmount($source_funding_amount)
    {
        $this->source_funding_amount = $source_funding_amount;

        return $this;
    }
 
    /**
     * Get the value of auditor_id
     *
     * @return mixed
     */
    public function getAuditorID()
    {
        return $this->auditor_id;
    }
 
    /**
     * Set the value of auditor_id
     *
     * @param mixed auditor_id
     *
     * @return self
     */
    public function setAuditorID($auditor_id)
    {
        $this->auditor_id = $auditor_id;

        return $this;
    }
	
    /**
     * Get the value of auditor_name
     *
     * @return mixed
     */
    public function getAuditorName()
    {
        return $this->auditor_name;
    }
 
    /**
     * Set the value of auditor_name
     *
     * @param mixed auditor_name
     *
     * @return self
     */
    public function setAuditorName($auditor_name)
    {
        $this->auditor_name = $auditor_name;

        return $this;
    }
 
    /**
     * Get the value of auditor_address
     *
     * @return mixed
     */
    public function getAuditorAddress()
    {
        return $this->auditor_address;
    }
 
    /**
     * Set the value of auditor_address
     *
     * @param mixed auditor_address
     *
     * @return self
     */
    public function setAuditorAddress($auditor_address)
    {
        $this->auditor_address = $auditor_address;

        return $this;
    }
 
    /**
     * Get the value of auditor_telephone
     *
     * @return mixed
     */
    public function getAuditorTelephone()
    {
        return $this->auditor_telephone;
    }
 
    /**
     * Set the value of auditor_telephone
     *
     * @param mixed auditor_telephone
     *
     * @return self
     */
    public function setAuditorTelephone($auditor_telephone)
    {
        $this->auditor_telephone = $auditor_telephone;

        return $this;
    }
 
    /**
     * Get the value of auditor_email
     *
     * @return mixed
     */
    public function getAuditorEmail()
    {
        return $this->auditor_email;
    }
 
    /**
     * Set the value of auditor_email
     *
     * @param mixed auditor_email
     *
     * @return self
     */
    public function setAuditorEmail($auditor_email)
    {
        $this->auditor_email = $auditor_email;

        return $this;
    }
 
    /**
     * Get the value of organization_bank_id
     *
     * @return mixed
     */
    public function getOrganizationBankID()
    {
        return $this->organization_bank_id;
    }
 
    /**
     * Set the value of organization_bank_id
     *
     * @param mixed organization_bank_id
     *
     * @return self
     */
    public function setOrganizationBankID($organization_bank_id)
    {
        $this->organization_bank_id = $organization_bank_id;

        return $this;
    }
	
    /**
     * Get the value of bank_id
     *
     * @return mixed
     */
    public function getBankID()
    {
        return $this->bank_id;
    }
 
    /**
     * Set the value of bank_id
     *
     * @param mixed bank_id
     *
     * @return self
     */
    public function setBankID($bank_id)
    {
        $this->bank_id = $bank_id;

        return $this;
    }
 
    /**
     * Get the value of bank_address
     *
     * @return mixed
     */
    public function getBankAddress()
    {
        return $this->bank_address;
    }
 
    /**
     * Set the value of bank_address
     *
     * @param mixed bank_address
     *
     * @return self
     */
    public function setBankAddress($bank_address)
    {
        $this->bank_address = $bank_address;

        return $this;
    }
 
    /**
     * Get the value of bank_telephone
     *
     * @return mixed
     */
    public function getBankTelephone()
    {
        return $this->bank_telephone;
    }
 
    /**
     * Set the value of bank_telephone
     *
     * @param mixed bank_telephone
     *
     * @return self
     */
    public function setBankTelephone($bank_telephone)
    {
        $this->bank_telephone = $bank_telephone;

        return $this;
    }
 
    /**
     * Get the value of bank_email
     *
     * @return mixed
     */
    public function getBankEmail()
    {
        return $this->bank_email;
    }
 
    /**
     * Set the value of bank_email
     *
     * @param mixed bank_email
     *
     * @return self
     */
    public function setBankEmail($bank_email)
    {
        $this->bank_email = $bank_email;

        return $this;
    }
 
 /**
     * Get the value of tep_id
     *
     * @return mixed
     */
    public function getTEPID()
    {
        return $this->tep_id;
    }

    /**
     * Set the value of tep_id
     *
     * @param mixed tep_id
     *
     * @return self
     */
    public function setTEPID($tep_id)
    {
        $this->tep_id = $tep_id;

        return $this;
    }

    /**
     * Get the value of tep_fullname
     *
     * @return mixed
     */
    public function getTEPFullname()
    {
        return $this->tep_fullname;
    }

    /**
     * Set the value of tep_fullname
     *
     * @param mixed tep_fullname
     *
     * @return self
     */
    public function setTEPFullname($tep_fullname)
    {
        $this->tep_fullname = $tep_fullname;

        return $this;
    }

    /**
     * Get the value of tep_nationality
     *
     * @return mixed
     */
    public function getTEPNationality()
    {
        return $this->tep_nationality;
    }

    /**
     * Set the value of tep_nationality
     *
     * @param mixed tep_nationality
     *
     * @return self
     */
    public function setTEPNationality($tep_nationality)
    {
        $this->tep_nationality = $tep_nationality;

        return $this;
    }

    /**
     * Get the value of tep_passport_number
     *
     * @return mixed
     */
    public function getTEPPassportNumber()
    {
        return $this->tep_passport_number;
    }

    /**
     * Set the value of tep_passport_number
     *
     * @param mixed tep_passport_number
     *
     * @return self
     */
    public function setTEPPassportNumber($tep_passport_number)
    {
        $this->tep_passport_number = $tep_passport_number;

        return $this;
    }
	
    /**
     * Get the value of document_id
     *
     * @return mixed
     */
    public function getDocumentID()
    {
        return $this->document_id;
    }
 
    /**
     * Set the value of document_id
     *
     * @param mixed document_id
     *
     * @return self
     */
    public function setDocumentID($document_id)
    {
        $this->document_id = $document_id;

        return $this;
    }
 
    /**
     * Get the value of documents
     *
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->documents;
    }
 
    /**
     * Set the value of documents
     *
     * @param mixed documents
     *
     * @return self
     */
    public function setDocuments($documents)
    {
        $this->documents = $documents;

        return $this;
    }
 
    /**
     * Get the value of captured_by
     *
     * @return mixed
     */
    public function getCapturedBy()
    {
        return $this->captured_by;
    }
 
    /**
     * Set the value of captured_by
     *
     * @param mixed captured_by
     *
     * @return self
     */
    public function setCapturedBy($captured_by)
    {
        $this->captured_by = $captured_by;

        return $this;
    }  
	
    /**
     * Get the value of action
     *
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }
 
    /**
     * Set the value of action
     *
     * @param mixed action
     *
     * @return self
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }  
  
   /**
     * Get the value of user_action
     *
     * @return mixed
     */
    public function getUserAction()
    {
        return $this->user_action;
    }
 
    /**
     * Set the value of user_action
     *
     * @param mixed user_action
     *
     * @return self
     */
    public function setUserAction($user_action)
    {
        $this->user_action = $user_action;

        return $this;
    }  
  
    /**
     * Get the value of last_edited_by
     *
     * @return mixed
     */
    public function getLastEditedBy()
    {
        return $this->last_edited_by;
    }

    /**
     * Set the value of last_edited_by
     *
     * @param mixed last_edited_by
     *
     * @return self
     */
    public function setLastEditedBy($last_edited_by)
    {
        $this->last_edited_by = $last_edited_by;

        return $this;
    }
	
	/**
     * Get the value of approved_by
     *
     * @return mixed
     */
    public function getApprovedBy()
    {
        return $this->approved_by;
    }

    /**
     * Set the value of approved_by
     *
     * @param mixed approved_by
     *
     * @return self
     */
    public function setApprovedBy($approved_by)
    {
        $this->approved_by = $approved_by;

        return $this;
    }

    /**
     * Get the value of deleted_by
     *
     * @return mixed
     */
    public function getDeletedBy()
    {
        return $this->deleted_by;
    }

    /**
     * Set the value of deleted_by
     *
     * @param mixed deleted_by
     *
     * @return self
     */
    public function setDeletedBy($deleted_by)
    {
        $this->deleted_by = $deleted_by;

        return $this;
    }
	
   /**
     * Get the value of rejected_comments
     *
     * @return mixed
     */
    public function getRejectedComments()
    {
        return $this->rejected_comments;
    }

    /**
     * Set the value of rejected_comments
     *
     * @param mixed rejected_comments
     *
     * @return self
     */
    public function setRejectedComments($rejected_comments)
    {
        $this->rejected_comments = $rejected_comments;

        return $this;
    }

	/**
     * Get the value of reporting_year
     *
     * @return mixed
     */
    public function getReportingYear()
    {
        return $this->reporting_year;
    }

    /**
     * Set the value of reporting_year
     *
     * @param mixed reporting_year
     *
     * @return self
     */
    public function setReportingYear($reporting_year)
    {
        $this->reporting_year = $reporting_year;

        return $this;
    }
	
	/**
     * Get the value of record_control
     *
     * @return mixed
     */
    public function getRecordControl()
    {
        return $this->record_control;
    }

    /**
     * Set the value of record_control
     *
     * @param mixed record_control
     *
     * @return self
     */
    public function setRecordControl($record_control)
    {
        $this->record_control = $record_control;

        return $this;
    }

    /**
     * Submit annual return
	 *
     */
    public function submit()
	{	
		global $APPROVAL_STATUS;	
		$draft = array_keys($APPROVAL_STATUS)[0];
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$reporting_year = date("Y");
		$exists = common::exists("licensing_organization", 0, "organization_id", $this->organization_id, "reporting_year", $reporting_year);

        if ($exists) {
            $_SESSION["message"] = "$reporting_year license request for '$this->organization_name' already submitted";
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }
				
		// 1. submit annual return
		$sql = "INSERT INTO {$table_prefix}licensing_organization (organization_id, abbreviation, organization_name, charity_number, telephone, email, registration_type, ";
		$sql .= "postal_address, physical_address, district_id, executive_director_fullname, executive_director_nationality, executive_director_national_id, ";
		$sql .= "executive_director_highest_qualification, executive_director_email, executive_director_telephone, financial_year_start_month, financial_year_end_month, ";
		$sql .= "annual_income, organization_type, record_control, reporting_year, captured_by, captured_date, status) VALUES('";
		$sql .= $conn->real_escape_string($this->organization_id) . "', '";
		$sql .= $conn->real_escape_string($this->abbreviation) . "', '" . $conn->real_escape_string($this->organization_name) . "', '";
		$sql .= $conn->real_escape_string($this->charity_number) . "', '" . $conn->real_escape_string($this->telephone) . "', '";
		$sql .= $conn->real_escape_string($this->email) . "', '" . $conn->real_escape_string($this->registration_type) . "', '";
		$sql .= $conn->real_escape_string($this->postal_address) . "', '" . $conn->real_escape_string($this->physical_address) . "', '";
		$sql .= $conn->real_escape_string($this->district_id) . "', '" . $conn->real_escape_string($this->executive_director_fullname) . "', '";
		$sql .= $conn->real_escape_string($this->executive_director_nationality) . "', '" . $conn->real_escape_string($this->executive_director_national_id) . "', '";
		$sql .= $conn->real_escape_string($this->executive_director_highest_qualification) . "', '";
		$sql .= $conn->real_escape_string($this->executive_director_email) . "', '" . $conn->real_escape_string($this->executive_director_telephone) . "', '";
		$sql .= $conn->real_escape_string($this->financial_year_start_month) . "', '" . $conn->real_escape_string($this->financial_year_end_month) . "', '";
		$sql .= $conn->real_escape_string($this->annual_income) . "', '" . $conn->real_escape_string($this->organization_type) . "', '";
		$sql .= $conn->real_escape_string($this->record_control) . "', '" . $conn->real_escape_string($reporting_year) . "', '";
		$sql .= $conn->real_escape_string($this->captured_by) . "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE) . "')";		
		$result = $conn->query($sql);
		
		$licensing_organization_id = mysqli_insert_id($conn);		
		if ($result) {
			// successfully submitted annual return
			
			$log_data_activity = false;
			$action = "submit";
			// 2. save annual return data: organizational objectives
			self::processOrganizationData($licensing_organization_id, "objective", $this->objectives, $action, $this->captured_by, $log_data_activity);

			// 3. save annual return data: staff capacity
			self::processOrganizationData($licensing_organization_id, "staff capacity", $this->staff_capacity_type, $action, $this->captured_by, $log_data_activity, 
									 	  $this->staff_capacity_number);	
									  		
			// 4. save annual return data: sectors
			self::processOrganizationData($licensing_organization_id, "sector", $this->sectors, $action, $this->captured_by, $log_data_activity);

			// 5. save annual return data: location activities
			self::processOrganizationData($licensing_organization_id, "location activity", $this->location_activities_vdc, $action, $this->captured_by, $log_data_activity, 
									 	  $this->location_activities_adc, $this->location_activities_district_id);	
									  		
			// 6. save annual return data: target groups
			self::processOrganizationData($licensing_organization_id, "target group", $this->target_groups, $action, $this->captured_by, $log_data_activity);

			// 7. save annual return data: directors/trustees
			self::processOrganizationData($licensing_organization_id, "trustee", $this->directors_trustees_fullname, $action, $this->captured_by, $log_data_activity, 
										  $this->directors_trustees_telephone, $this->directors_trustees_email, $this->directors_trustees_occupation, 
									 	  $this->directors_trustees_nationality, $this->directors_trustees_national_id, $this->directors_trustees_position, 
										  $this->directors_trustees_timeframe);
									  
			// 8. save annual return data: source of funding
			self::processOrganizationData($licensing_organization_id, "source funding", $this->source_funding_donor_id, $action, $this->captured_by, $log_data_activity, 
									 	  $this->source_funding_contact_details, $this->source_funding_currency, $this->source_funding_amount);

			// 9. save annual return data: auditor's details 
			self::processOrganizationData($licensing_organization_id, "auditor", $this->auditor_name, $action, $this->captured_by, $log_data_activity, $this->auditor_address, 
									 	  $this->auditor_telephone, $this->auditor_email);
										  
			// 10. save annual return data: bank details
			self::processOrganizationData($licensing_organization_id, "bank", $this->bank_id, $action, $this->captured_by, $log_data_activity, $this->bank_address, 
										  $this->bank_telephone, $this->bank_email);
									  
										  
			// 11. save annual return data: temporary employment permit applications
			self::processOrganizationData($licensing_organization_id, "tep", $this->tep_fullname, $action, $this->captured_by, $log_data_activity, $this->tep_nationality, 
										  $this->tep_passport_number);
									  
			// 12. save annual return data: documents
			self::processOrganizationDocuments($licensing_organization_id, $this->organization_id, $this->documents, $action, $this->captured_by, $reporting_year, 
											   $log_data_activity);
			
			// confirmation message to the user
			if ($this->record_control == $draft) {
				$message = "$reporting_year license request for '$this->organization_name'" . MESSAGE_SUCCESS . "saved as draft";
				$log_message = $message;
			} else {
				$subject_str = "License Request - $this->organization_name";
				$licensee = common::getFieldValue("system", "licensee");
				$technical_support_contact = common::getFieldValue("system", "technical_support_contact");
				$technical_support_telephone = common::getFieldValue("system", "telephone");
				$technical_support_email = common::getFieldValue("system", "email");
				$technical_support_website = common::getFieldValue("system", "website");
				
				$technical_support_contact_str = "<i class=\"fa fa-user-o\"></i> $technical_support_contact";
				$technical_support_email_str = "<i class=\"fa fa-at\"></i> <a href=\"mailto:$technical_support_email?subject=$subject_str\">$technical_support_email</a>";
				$technical_support_telephone_str = " <i class=\"fa fa-phone\"></i> $technical_support_telephone";				
				$technical_support_str = "$technical_support_contact_str $technical_support_email_str $technical_support_telephone_str";
	
				$message = "Thank you for submitting your $reporting_year license request for '$this->organization_name'. You can track the status of your request by ";				
				$message_email = "<p>" . $message . "login to <a href=\"" . SYS_URL . VIEWS_PATH . "licensing\">myNGO</a>.</p>";
				$message .= "clicking on the information button. If in doubt, you may contact us. <b>$technical_support_str</b>";			
				
				$log_message = "$reporting_year license request for '$this->organization_name'" . MESSAGE_SUCCESS . "submitted";
				
				// email confirmation to user
				$to_email_e = common::getFieldValue("user", "email", "username", $this->captured_by, "organization_id", $this->organization_id);	
				if (!empty($to_email_e)) {
					$to_email[] = array($to_email_e);
					$subject[] = $subject_str;		
					$to_firstname = common::getFieldValue("user", "firstname", "username", $this->captured_by, "organization_id", $this->organization_id);
					$email_body[] = "Dear $to_firstname,</p>" . $message_email;
				}

				// email approvers
				$page_id_awaiting_approval_1 = 67;
				$blanks = "";
				$search_query = "role_id IN (SELECT role_id FROM {$table_prefix}role WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND menu_ids LIKE ";
				$search_query .= "'%|$page_id_awaiting_approval_1" . "RW|%' AND email IS NOT NULL)";														 
				$approver_emails = array_unique(array_column(user::all($blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $search_query), "email"));
				$subject_str = "License Request Awaiting Approval - $this->organization_name";
				$message_email = "Dear Approver,</p><p>A $reporting_year license request for '$this->organization_name' has been submitted awaiting your approval. ";
				$message_email .= "To approve, login to <a href=\"" . SYS_URL . VIEWS_PATH . "licensing_approval_1\">myNGO</a>.</p>";				
				if (!empty($approver_emails)) {	
					$to_email[] = $approver_emails;
					$subject[] = $subject_str;								
					$email_body[] = $message_email;
				}
								
				if (!empty($to_email)) {
					$send_email = new send_email();				
					$send_email->setToEmail($to_email);
					$send_email->setSubject($subject);
					$send_email->setMessage($email_body);				
					$send_email->send();
				}	
			}
			$_SESSION["message"] = $message;
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
			$log_message = MESSAGE_ERROR;
		}
		
		// log the user activity
		audit_trail::log_trail("License", $log_message, $this->captured_by, "License", $licensing_organization_id);
	}
	
	/**
     * Edit annual return
	 *
     */
    public function edit()
	{
		global $APPROVAL_STATUS;	
		$draft = array_keys($APPROVAL_STATUS)[0]; 
		$awaiting_approval_level1 = array_keys($APPROVAL_STATUS)[1];
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$exists = common::exists("licensing_organization", $this->licensing_organization_id, "organization_id", $this->organization_id, "reporting_year", $this->reporting_year);

        if ($exists) {
            $_SESSION["message"] = "$this->reporting_year license request for '$this->organization_name' already submitted";
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }
		
		// 1. edit annual return details
		// if Annual return data is already approved, only update selected fields
		$sql = "UPDATE {$table_prefix}licensing_organization SET telephone = '" . $conn->real_escape_string($this->telephone) . "', ";
		$sql .= "email = '".$conn->real_escape_string($this->email) . "', postal_address = '" . $conn->real_escape_string($this->postal_address) . "', ";
		$sql .= "executive_director_fullname = '" . $conn->real_escape_string($this->executive_director_fullname) . "', ";
		$sql .= "executive_director_nationality = '" . $conn->real_escape_string($this->executive_director_nationality) . "', ";
		$sql .= "executive_director_national_id = '" . $conn->real_escape_string($this->executive_director_national_id) . "', ";
		$sql .= "executive_director_highest_qualification = '" . $conn->real_escape_string($this->executive_director_highest_qualification) . "', ";
		$sql .= "executive_director_email = '" . $conn->real_escape_string($this->executive_director_email) . "', ";
		$sql .= "executive_director_telephone = '" . $conn->real_escape_string($this->executive_director_telephone) . "', ";
		$sql .= "financial_year_start_month = '" . $conn->real_escape_string($this->financial_year_start_month) . "', ";
		$sql .= "financial_year_end_month = '" . $conn->real_escape_string($this->financial_year_end_month) . "', ";
		$sql .= "annual_income = '" . $conn->real_escape_string($this->annual_income) . "', ";
		$sql .= "last_edited_by = '" . $conn->real_escape_string($this->last_edited_by) . "', last_edited_date = NOW() ";
		
		if ($this->record_control == $draft) {
			// if NGO annual return data is in draft state, update all fields	
			$sql .= ", abbreviation = '" . $conn->real_escape_string($this->abbreviation) . "', ";
			$sql .= "organization_name = '" .$conn->real_escape_string($this->organization_name)."', charity_number = '" . $conn->real_escape_string($this->charity_number) ."', ";
			$sql .= "organization_type = '" . $conn->real_escape_string($this->organization_type) . "', ";
			$sql .= "registration_type = '" . $conn->real_escape_string($this->registration_type) . "', ";
			$sql .= "physical_address = '" . $conn->real_escape_string($this->physical_address) . "', district_id = '" . $conn->real_escape_string($this->district_id) . "' ";
		}
		
		// if action is to submit and NGO annual return data is in draft state, update the record control as well	
		if ($this->user_action === "submit" && $this->record_control == $draft) {
			$sql .= ", record_control = '" . $conn->real_escape_string($awaiting_approval_level1) . "', ";
	
			// clear rejected fields as well, just in case the annual return was previously rejected
			$sql .= "rejected_by = NULL, rejected_date = NULL, rejected_comments = NULL, status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' ";
		}
		
		$sql .= "WHERE licensing_organization_id = '" . $conn->real_escape_string($this->licensing_organization_id) . "'";

		$result = $conn->query($sql);

        if ($result) {
			// successfully edited annual return details
			// if NGO annual return data is in draft state, update all fields
			if ($this->record_control == $draft) {
				$log_data_activity = false;
				$action = "edit";
				// 2. edit annual return data: organizational objectives
				self::processOrganizationData($this->licensing_organization_id, "objective", $this->objectives, $action, $this->last_edited_by, $log_data_activity, 
											  $this->objective_id);
				
				// 3. edit annual return data: staff capacity
				self::processOrganizationData($this->licensing_organization_id, "staff capacity", $this->staff_capacity_type, $action, $this->last_edited_by, $log_data_activity, 
										  	  $this->staff_capacity_id, $this->staff_capacity_number);
									  		
				// 4. edit annual return data: sectors
				self::processOrganizationData($this->licensing_organization_id, "sector", $this->sectors, $action, $this->last_edited_by, $log_data_activity, $this->sector_id);
				
				// 5. edit annual return data: location activities
				self::processOrganizationData($this->licensing_organization_id, "location activity", $this->location_activities_vdc, $action, $this->last_edited_by,
											  $log_data_activity, $this->location_activity_id, $this->location_activities_adc, $this->location_activities_district_id);	
												
				// 6. edit annual return data: target groups
				self::processOrganizationData($this->licensing_organization_id, "target group", $this->target_groups, $action, $this->last_edited_by, $log_data_activity, 
											  $this->target_group_id);
				
				// 7. edit annual return data: directors/trustees
				self::processOrganizationData($this->licensing_organization_id, "trustee", $this->directors_trustees_fullname, $action, $this->last_edited_by, $log_data_activity, 
											  $this->trustee_id, $this->directors_trustees_telephone, $this->directors_trustees_email, $this->directors_trustees_occupation, 
											  $this->directors_trustees_nationality, $this->directors_trustees_national_id, $this->directors_trustees_position, 
											  $this->directors_trustees_timeframe);
									  
				// 8. edit annual return data: source of funding
				self::processOrganizationData($this->licensing_organization_id, "source funding", $this->source_funding_donor_id, $action, $this->last_edited_by, 
											  $log_data_activity, $this->source_funding_id, $this->source_funding_contact_details, $this->source_funding_currency, 
											  $this->source_funding_amount);
	
				// 9. edit annual return data: auditor's details 
				self::processOrganizationData($this->licensing_organization_id, "auditor", $this->auditor_name, $action, $this->last_edited_by, $log_data_activity,
											  $this->auditor_id, $this->auditor_address, $this->auditor_telephone, $this->auditor_email);
				
				// 10. edit annual return data: bank details
				self::processOrganizationData($this->licensing_organization_id, "bank", $this->bank_id, $action, $this->last_edited_by, $log_data_activity, 
											  $this->organization_bank_id, $this->bank_address, $this->bank_telephone, $this->bank_email);

				// 11. edit annual return data: temporary employment permit applications
				self::processOrganizationData($this->licensing_organization_id, "tep", $this->tep_fullname, $action, $this->last_edited_by, $log_data_activity, $this->tep_id, 
										  	  $this->tep_nationality, $this->tep_passport_number);									  
									  										  
				// 12. edit annual return data: documents
				self::processOrganizationDocuments($this->licensing_organization_id, $this->organization_id, $this->documents, $action, $this->last_edited_by,
												   $this->reporting_year, $log_data_activity);
			}
			
			// confirmation message to the user
			$message = "$this->reporting_year license request for '$this->organization_name'" . MESSAGE_SUCCESS;
			$message .= ($this->record_control == $draft) ? "saved as draft" : "updated";
			$log_message = $message;
			
			if ($this->user_action === "submit" && $this->record_control == $draft) {				
				$subject_str = "License Request - $this->organization_name";
				$licensee = common::getFieldValue("system", "licensee");
				$technical_support_contact = common::getFieldValue("system", "technical_support_contact");
				$technical_support_telephone = common::getFieldValue("system", "telephone");
				$technical_support_email = common::getFieldValue("system", "email");
				$technical_support_website = common::getFieldValue("system", "website");
				
				$technical_support_contact_str = "<i class=\"fa fa-user-o\"></i> $technical_support_contact";
				$technical_support_email_str = "<i class=\"fa fa-at\"></i> <a href=\"mailto:$technical_support_email?subject=$subject_str\">$technical_support_email</a>";
				$technical_support_telephone_str = " <i class=\"fa fa-phone\"></i> $technical_support_telephone";				
				$technical_support_str = "$technical_support_contact_str $technical_support_email_str $technical_support_telephone_str";
	
				$message = "Thank you for submitting your $this->reporting_year license request for '$this->organization_name'. You can track the status of your request by ";				
				$message_email = "<p>" . $message . "login to <a href=\"" . SYS_URL . VIEWS_PATH . "licensing\">myNGO</a>.</p>";
				$message .= "clicking on the information button. If in doubt, you may contact us. <b>$technical_support_str</b>";			
				
				$log_message = "$this->reporting_year license request for '$this->organization_name'" . MESSAGE_SUCCESS . "submitted";
				
				// email confirmation to user
				$to_email_e = common::getFieldValue("user", "email", "username", $this->last_edited_by, "organization_id", $this->organization_id);	
				
				if (!empty($to_email_e)) {
					$to_email[] = array($to_email_e);
					$subject[] = $subject_str;		
					$to_firstname = common::getFieldValue("user", "firstname", "username", $this->last_edited_by, "organization_id", $this->organization_id);
					$email_body[] = "Dear $to_firstname,</p>" . $message_email;
				}

				// email approvers
				$page_id_awaiting_approval_1 = 67;
				$blanks = "";
				$search_query = "role_id IN (SELECT role_id FROM {$table_prefix}role WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND menu_ids LIKE ";
				$search_query .= "'%|$page_id_awaiting_approval_1" . "RW|%' AND email IS NOT NULL)";														 
				$approver_emails = array_unique(array_column(user::all($blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $search_query), "email"));
				$subject_str = "License Request Awaiting Approval - $this->organization_name";
				$message_email = "Dear Approver,</p><p>A $this->reporting_year license request for '$this->organization_name' has been submitted awaiting your approval. ";
				$message_email .= "To approve, login to <a href=\"" . SYS_URL . VIEWS_PATH . "licensing_approval_1\">myNGO</a>.</p>";				
				
				if (!empty($approver_emails)) {	
					$to_email[] = $approver_emails;
					$subject[] = $subject_str;								
					$email_body[] = $message_email;
				}
								
				if (!empty($to_email)) {
					$send_email = new send_email();				
					$send_email->setToEmail($to_email);
					$send_email->setSubject($subject);
					$send_email->setMessage($email_body);				
					$send_email->send();
				}
			}
			
			$_SESSION["message"] = $message;
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;					
        } else {
            $_SESSION["message"] = MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
			$log_message = MESSAGE_ERROR;
        }
		
		// log the user activity
		audit_trail::log_trail(ucwords($this->user_action), $log_message, $this->last_edited_by, "License", $this->licensing_organization_id);
	}
	
	/**
     * Approve annual return
	 *
     */
    public function approve()
	{
		global $APPROVAL_STATUS;	
		$approved = array_keys($APPROVAL_STATUS)[3];
		$payment_processed = array_keys($APPROVAL_STATUS)[4];

		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		$level_str = "";
		$generate_certificate = false;
		$update_organization = false;
		$payment_processed_sql = "";
		$new_record_control = "";
		
		if ($this->action === "approve") {
			$level_str = " (Level $this->record_control)";
			$new_record_control = $this->record_control + 1;
			$record_control_sql = "record_control = '" . $conn->real_escape_string($new_record_control) . "', ";
			$rejection_sql = "";
			$actioned = $this->action . "d";
			$field_approved_by = $actioned . $this->record_control . "_by";
			$field_approved_date = $actioned . $this->record_control . "_date";
			
			if ($new_record_control == $approved) {
				$generate_certificate = true;
			} elseif ($new_record_control == $payment_processed) {
				$field_approved_by = "payment_processed_by";
				$field_approved_date = "payment_processed_date";
				$payment_processed_sql = " AND record_control <> '" . $conn->real_escape_string($new_record_control) . "'";
				$update_organization = true;
			}

		} elseif ($this->action === "reject") {
			$record_control_sql = "";
			$rejection_sql = "rejected_comments = '" . $conn->real_escape_string($this->rejected_comments) . "', status= '" . $conn->real_escape_string(STATUS_REJECTED) . "', "; 
			$actioned = $this->action . "ed";
			$field_approved_by = $actioned . "_by";
			$field_approved_date = $actioned . "_date";
		}
				
		$sql="UPDATE {$table_prefix}licensing_organization SET $record_control_sql$rejection_sql$field_approved_by = '".$conn->real_escape_string($this->approved_by)."',";
		$sql .= "$field_approved_date = NOW() WHERE licensing_organization_id = '" . $conn->real_escape_string($this->licensing_organization_id) . "'$payment_processed_sql";

		$result = $conn->query($sql);

        if ($result) {
			// successfully approved annual return 		
			$message = "$this->reporting_year license request for '$this->organization_name'" . MESSAGE_SUCCESS . $actioned . $level_str;
			$message_type = MESSAGE_SUCCESS_TYPE;
			
			// inform the next user (second approver/finance/requestor) to act on the request
			$page_id_approval = 68; // awaiting approval (level 2), inform second level approvers
			$url = "licensing_approval_2";
			$subject_str = "License Request Awaiting Approval";
			$message_email = "Dear Approver,</p><p>A $this->reporting_year license request for '$this->organization_name' has been submitted awaiting your approval. ";
			$task = "approve";
			$ngo_registration_number = common::getFieldValue("organization", "registration_number", "organization_id", $this->organization_id);
			$blanks = "";
			$search_query = "role_id IN (SELECT role_id FROM {$table_prefix}role WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND menu_ids LIKE ";
			$search_query .= "'%|$page_id_approval" . "RW|%' AND email IS NOT NULL)";														 
			$approver_emails = array_unique(array_column(user::all($blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $search_query), "email"));
 			
			// ensure to get the correct requestor even for rejected annual returns
			$requested_by = common::getFieldValue("licensing_organization", "captured_by", "licensing_organization_id", $this->licensing_organization_id, $blanks, $blanks,
												  $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE . "', '" . STATUS_REJECTED);
			$requestor_firstname = common::getFieldValue("user", "firstname", "username", $requested_by, "organization_id", $this->organization_id);
			
			if ($this->action === "approve") {
				if ($new_record_control == $approved) {
					$page_id_approval = 58; // awaiting payment processing, inform Finance
					$url = "payment";
					$subject_str = "License Request Awaiting Payment Processing";
					$message_email = "Dear Finance,</p><p>A $this->reporting_year license request for '$this->organization_name ($ngo_registration_number)' has been approved ";
					$message_email .= "awaiting payment processing. ";
					$task = "process payment";
					$search_query = "role_id IN (SELECT role_id FROM {$table_prefix}role WHERE status = '" . $conn->real_escape_string(STATUS_ACTIVE) . "' AND menu_ids LIKE ";
					$search_query .= "'%|$page_id_approval" . "RW|%' AND email IS NOT NULL)";														 
					$approver_emails = array_unique(array_column(user::all($blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $search_query), "email"));
				} elseif ($new_record_control == $payment_processed) {
					// approved, inform requestor
					$url = "licensing";
					$subject_str = "License Request Approved";
					$approver_emails = array(common::getFieldValue("user", "email", "username", $requested_by, "organization_id", $this->organization_id));
					$message_email = "Dear $requestor_firstname,</p><p>Your $this->reporting_year license request for '$this->organization_name' has been approved. ";
					$task = "track the status of your license request";
				}
			} elseif ($this->action === "reject") {
				// rejected, inform requestor
				$url = "licensing";
				$subject_str = "License Request Rejected";
				$rejected_comments = common::getFieldValue("licensing_organization", "rejected_comments", "licensing_organization_id", $this->licensing_organization_id, $blanks,
														   $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, $blanks, STATUS_ACTIVE ."', '".STATUS_REJECTED);
				$approver_emails = array(common::getFieldValue("user", "email", "username", $requested_by, "organization_id", $this->organization_id));
				$message_email = "Dear $requestor_firstname,</p><p>Your request for the $this->reporting_year license for '$this->organization_name' has been rejected with the ";				
				$message_email .= "following reasons: </p><p><b>" . str_replace("\r\n", "<br />", $rejected_comments) . "</b></p><p>";
				$task = "review your request";
			}
			
			$subject_str .= " - $this->organization_name";
			if (strlen($ngo_registration_number) > 0) $subject_str .= " ($ngo_registration_number)";
			
			$message_email .= "To $task, login to <a href=\"" . SYS_URL . VIEWS_PATH . "$url\">myNGO</a>.</p>";		
			$to_email = array();
			if (!empty($approver_emails)) {	
				$to_email[] = $approver_emails;
				$subject[] = $subject_str;								
				$email_body[] = $message_email;
				$email_attachment[] = NULL;
			}
				
			// if this is a final approval then generate a new license for the NGO
			if ($generate_certificate) {
				// firstly generate an invoice, starting with license fees
				$license_fees = array_unique(array_column(fee::all(INVOICE_TIME_YEARLY), "fee_category"));
					
				// then get the TEP processing certificate request fees
				$teps = self::getOrganizationData($this->licensing_organization_id, "tep");
				$TEP_details = array_column($teps, "fullname");
				$number_of_TEP_requests = count($TEP_details);					
				for ($i = 0; $i < $number_of_TEP_requests; $i++) {
					$license_fees = array_merge($license_fees, array_unique(array_column(fee::all(INVOICE_TIME_TEP), "fee_category")));
				}
								
				$invoice = new invoice();
				$invoice->setOrganizationID(array($this->organization_id));
				$invoice->setFeeCategory($license_fees);
				$invoice->setTEPDetails($TEP_details);
				$invoice->setInvoiceYear($this->reporting_year);													
				$invoice->setCapturedBy($this->approved_by);					
				$invoice->generate();
				
				$processing_result = (isset($_SESSION["message"])) ?  $_SESSION["message"] : "";
				$is_invoiced = (strpos(strtolower($processing_result), strtolower(MESSAGE_SUCCESS)) === false) ? false : true;
				
				if (!$is_invoiced) {
					//  license renewal fee invoice was not generated successfully
					$message .= ", but " . strtolower(implode(" and ", array_unique($license_fees))) . " invoice could not be generated: " . ucfirst($processing_result);
					$message_type = MESSAGE_INFORMATION_TYPE;
				} else {
					// license renewal fee invoice was generated successfully...generate license
				
					// get the newly generated invoice number from above						
					if (isset($_SESSION["invoice_number"])) {
						$invoice_number = $_SESSION["invoice_number"];
						unset($_SESSION["invoice_number"]);
					} else {
						$invoice_number = "";
					}
					
					// email the invoice to the requestor
					$url = "licensing";
					$subject_str = "Invoice for $this->reporting_year license request - $this->organization_name";
					if (strlen($ngo_registration_number) > 0) $subject_str .= " ($ngo_registration_number)";
					$message_email = "Dear $requestor_firstname,</p><p>Find attached an invoice for the $this->reporting_year license request for '$this->organization_name'. ";					
					$message_email .= "To track the status of your request, login to <a href=\"" . SYS_URL . VIEWS_PATH . "$url\">myNGO</a>.</p>";	
					$requestor_email = array(common::getFieldValue("user", "email", "username", $requested_by, "organization_id", $this->organization_id));
					$currency = common::getFieldValue("currency", "currency", "is_default", "Yes");
					
					$report = new report();
					$report->setOrganizationID($this->organization_id);
					$report->setReportName("Invoice");
					$report->setInvoiceNumber($invoice_number);
					$report->setCurrency($currency);
					$report->setDestination(PDF_FILE_EXT);
					$report->setPrintedBy($this->approved_by);
					$report->setReturnReport(true);
		
					if (!empty($requestor_email)) {	
						$to_email[] = $requestor_email;
						$subject[] = $subject_str;								
						$email_body[] = $message_email;
						$email_attachment[] = array("file" => $report->generate(), "file_name" => "license_invoice.pdf");
					}
					
					$start_date = certificate::getPeriod(INVOICE_TIME_YEARLY, "start_date");		
					if (strlen($start_date) > 0) $start_date = $this->reporting_year . "-" . $start_date;
	
					$end_date = certificate::getPeriod(INVOICE_TIME_YEARLY, "end_date");		
					if (strlen($end_date) > 0) $end_date = $this->reporting_year . "-" . $end_date;
			
					$certificate_type = "License Renewal";				
					$certificates = new certificate();		
					$certificates->setOrganizationID($this->organization_id);	
					$certificates->setCategory(CERTIFICATE_LICENSE);
					$certificates->setStartDate($start_date);								
					$certificates->setEndDate($end_date);								
					$certificates->setDetails2($certificate_type);
					$certificates->setInvoiceNumber($invoice_number);
					$certificates->setCapturedBy($this->approved_by);					
					$certificates->generate();
					
					$processing_result = (isset($_SESSION["message"])) ?  $_SESSION["message"] : "";
					$is_generated = (strpos(strtolower($processing_result), strtolower(MESSAGE_SUCCESS)) === false) ? false : true;
					
					if (!$is_generated) {
						// license was not generated successfully
						$message .= ", but " . strtolower(CERTIFICATE_LICENSE) . " could not be generated: " . ucfirst($processing_result);
						$message_type = MESSAGE_INFORMATION_TYPE;
					} elseif ($number_of_TEP_requests > 0) {
						// license was generated successfully...generate TEP processing certificates
						$start_date = certificate::getPeriod(INVOICE_TIME_TEP, "start_date");		
						if (strlen($start_date) > 0) $start_date = $registration_year . "-" . $start_date;
		
						$end_date = certificate::getPeriod(INVOICE_TIME_TEP, "end_date");		
						if (strlen($end_date) > 0) $end_date = $registration_year . "-" . $end_date;
				
						$certificate_type = "New TEP";				
						$certificates = new certificate();		
						$certificates->setOrganizationID($this->organization_id);	
						$certificates->setCategory(CERTIFICATE_TEP);
						$certificates->setStartDate($start_date);								
						$certificates->setEndDate($end_date);								
						$certificates->setDetails1($TEP_details);
						$certificates->setDetails2($certificate_type);
						$certificates->setInvoiceNumber($invoice_number);
						$certificates->setCapturedBy($this->approved_by);					
						$certificates->generate();
						
						$processing_result = (isset($_SESSION["message"])) ?  $_SESSION["message"] : "";
						$is_generated = (strpos(strtolower($processing_result), strtolower(MESSAGE_SUCCESS)) === false) ? false : true;
						
						if (!$is_generated) {
							// TEP processing certificate was not generated successfully
							$message .= ", but " . strtolower(CERTIFICATE_TEP) . " could not be generated: " . ucfirst($processing_result);
							$message_type = MESSAGE_INFORMATION_TYPE;
						} else {
							// copy the TEP requests into the TEP table
							$tep_fullname = array_column($teps, "fullname");
							$tep_nationality = array_column($teps, "nationality");
							$tep_passport_number = array_column($teps, "passport_number");
							$tep_payment_proof = common::getFieldValue("licensing_organization_document", "filename", "document_category", DOCUMENT_CATEGORY_PAYMENT_PROOF_LICENSE,
																	   "licensing_organization_id",  $this->licensing_organization_id);	
							$tep = new tep();
							$tep->setOrganizationID($this->organization_id);
							$tep->setOrganizationName($this->organization_name);
							$tep->setInvoiceNumber($invoice_number);
							$tep->setFullname($tep_fullname);
							$tep->setNationality($tep_nationality);
							$tep->setPassportNumber($tep_passport_number);
							$tep->setPaymentProof($tep_payment_proof);		
							$tep->setUserAction("request");
							$tep->setRecordControl($approved);
							$tep->setCapturedBy($this->approved_by);	
							$tep->request();
						}
					}
				}
			} 
			
			// send email							
			if (!empty($to_email)) {
				$send_email = new send_email();				
				$send_email->setToEmail($to_email);
				$send_email->setSubject($subject);
				$send_email->setMessage($email_body);				
				$send_email->setAttachment($email_attachment);				
				$send_email->send();
			}	
			
			// if this is a final approval then update the NGO with the approved annual return info
			if ($update_organization) {			
				// NGO details		
				$organization_name = common::getFieldValue("licensing_organization", "organization_name", "licensing_organization_id", $this->licensing_organization_id);
				$abbreviation = common::getFieldValue("licensing_organization", "abbreviation", "licensing_organization_id", $this->licensing_organization_id);
				$charity_number = common::getFieldValue("licensing_organization", "charity_number", "licensing_organization_id", $this->licensing_organization_id);
				$telephone = common::getFieldValue("licensing_organization", "telephone", "licensing_organization_id", $this->licensing_organization_id);
				$email = common::getFieldValue("licensing_organization", "email", "licensing_organization_id", $this->licensing_organization_id);
				$organization_type = common::getFieldValue("licensing_organization", "organization_type", "licensing_organization_id", $this->licensing_organization_id);
				$registration_type = common::getFieldValue("licensing_organization", "registration_type", "licensing_organization_id", $this->licensing_organization_id);
				$postal_address = common::getFieldValue("licensing_organization", "postal_address", "licensing_organization_id", $this->licensing_organization_id);
				$district_id = common::getFieldValue("licensing_organization", "district_id", "licensing_organization_id", $this->licensing_organization_id);
				$physical_address = common::getFieldValue("licensing_organization", "physical_address", "licensing_organization_id", $this->licensing_organization_id);				
				$objective_details = self::getOrganizationData($this->licensing_organization_id, "objective");
				$objectives = array_column($objective_details, "objective");
				$objectives_id = array_column($objective_details, "objective_id");
				$staff_details = self::getOrganizationData($this->licensing_organization_id, "staff capacity");
				$staff_capacity_type = array_column($staff_details, "staff_type");
				$staff_capacity_number = array_column($staff_details, "staff_number");
				$staff_capacity_id = array_column($staff_details, "staff_capacity_id");

				// coverage				
				$sector_details = self::getOrganizationData($this->licensing_organization_id, "sector");
				$sectors = array_column($sector_details, "sector");
				$sector_id = array_column($sector_details, "sector_id");
				$location_activities_details = self::getOrganizationData($this->licensing_organization_id, "location activity");
				$location_activities_vdc = array_column($location_activities_details, "vdc");
				$location_activities_adc = array_column($location_activities_details, "adc");
				$location_activities_district_id = array_column($location_activities_details, "district_id");
				$location_activities_id = array_column($location_activities_details, "location_activity_id");
				$target_group_details = self::getOrganizationData($this->licensing_organization_id, "target group");
				$target_groups = array_column($target_group_details, "target_group");
				$target_group_id = array_column($target_group_details, "target_group_id");
								
				// governance
				$executive_director_fullname = common::getFieldValue("licensing_organization", "executive_director_fullname", "licensing_organization_id", 
																	 $this->licensing_organization_id);
				$executive_director_nationality = common::getFieldValue("licensing_organization", "executive_director_nationality", "licensing_organization_id", 
																	    $this->licensing_organization_id);
				$executive_director_national_id = common::getFieldValue("licensing_organization", "executive_director_national_id", "licensing_organization_id", 
																	    $this->licensing_organization_id);
				$executive_director_highest_qualification = common::getFieldValue("licensing_organization", "executive_director_highest_qualification","licensing_organization_id",
																				  $this->licensing_organization_id);
				$executive_director_email = common::getFieldValue("licensing_organization", "executive_director_email", "licensing_organization_id", 
																  $this->licensing_organization_id);
				$executive_director_telephone = common::getFieldValue("licensing_organization", "executive_director_telephone", "licensing_organization_id", 
																	  $this->licensing_organization_id);				
				$directors_trustees_details = self::getOrganizationData($this->licensing_organization_id, "trustee");
				$directors_trustees_fullname = array_column($directors_trustees_details, "fullname");
				$directors_trustees_telephone = array_column($directors_trustees_details, "telephone");
				$directors_trustees_email = array_column($directors_trustees_details, "email");
				$directors_trustees_occupation = array_column($directors_trustees_details, "occupation");
				$directors_trustees_nationality = array_column($directors_trustees_details, "nationality");
				$directors_trustees_national_id = array_column($directors_trustees_details, "national_id");
				$directors_trustees_position = array_column($directors_trustees_details, "position");
				$directors_trustees_timeframe = array_column($directors_trustees_details, "timeframe");
				$directors_trustees_id = array_column($directors_trustees_details, "trustee_id");
				
				// accounting
				$financial_year_start_month = common::getFieldValue("licensing_organization", "financial_year_start_month", "licensing_organization_id", 
																	$this->licensing_organization_id);
				$financial_year_end_month = common::getFieldValue("licensing_organization", "financial_year_end_month", "licensing_organization_id", 
																  $this->licensing_organization_id);
				$source_funding_details = self::getOrganizationData($this->licensing_organization_id, "source funding");
				$source_funding_donor_id = array_column($source_funding_details, "donor_id");
				$source_funding_contact_details = array_column($source_funding_details, "contact_details");
				$source_funding_currency = array_column($source_funding_details, "funding_currency");
				$source_funding_amount = array_column($source_funding_details, "funding_amount");
				$source_funding_id = array_column($source_funding_details, "source_funding_id");												  
				$auditor_details = self::getOrganizationData($this->licensing_organization_id, "auditor");
				$auditor_name = array_column($auditor_details, "name");
				$auditor_address = array_column($auditor_details, "address");
				$auditor_telephone = array_column($auditor_details, "telephone");
				$auditor_email = array_column($auditor_details, "email");
				$auditor_id = array_column($auditor_details, "auditor_id");			
				$bank_details = self::getOrganizationData($this->licensing_organization_id, "bank");
				$bank_id = array_column($bank_details, "bank_id");											  
				$bank_address = array_column($bank_details, "address");
				$bank_telephone = array_column($bank_details, "telephone");
				$bank_email = array_column($bank_details, "email");
				$organization_bank_id = array_column($bank_details, "organization_bank_id");

				// temporary employment permit applications
				$tep_details = self::getOrganizationData($this->licensing_organization_id, "tep");
				$tep_fullname = array_column($tep_details, "fullname");
				$tep_nationality = array_column($tep_details, "nationality");
				$tep_passport_number = array_column($tep_details, "passport_number");
				$tep_id = array_column($tep_details, "tep_id");
				
				// no documents...documents are specific to a particular year's annual return
		
				// other
				$action = "edit";
				$user_action = "update";
				$update_annual_return_info = "Yes";
				
				$organizations = new organization();
				
				// NGO details
				$organizations->setOrganizationID($this->organization_id);
				$organizations->setOrganizationName($organization_name);
				$organizations->setAbbreviation($abbreviation);
				$organizations->setCharityNumber($charity_number);
				$organizations->setTelephone($telephone);
				$organizations->setEmail($email);
				$organizations->setOrganizationType($organization_type);
				$organizations->setRegistrationType($registration_type);
				$organizations->setPostalAddress($postal_address);
				$organizations->setDistrictID($district_id);
				$organizations->setPhysicalAddress($physical_address);
				$organizations->setObjectiveID($objectives_id);
				$organizations->setObjectives($objectives);
				$organizations->setStaffCapacityID($staff_capacity_id);
				$organizations->setStaffCapacityType($staff_capacity_type);
				$organizations->setStaffCapacityNumber($staff_capacity_number);
				
				// coverage
				$organizations->setSectorID($sector_id);
				$organizations->setSectors($sectors);
				$organizations->setLocationActivityID($location_activities_id);
				$organizations->setLocationActivitiesVDC($location_activities_vdc);
				$organizations->setLocationActivitiesADC($location_activities_adc);
				$organizations->setLocationActivitiesDistrictID($location_activities_district_id);
				$organizations->setTargetGroupID($target_group_id);
				$organizations->setTargetGroups($target_groups);
				
				// governance
				$organizations->setExecutiveDirectorFullname($executive_director_fullname);
				$organizations->setExecutiveDirectorNationality($executive_director_nationality);
				$organizations->setExecutiveDirectorNationalID($executive_director_national_id);
				$organizations->setExecutiveDirectorHighestQualification($executive_director_highest_qualification);
				$organizations->setExecutiveDirectorEmail($executive_director_email);
				$organizations->setExecutiveDirectorTelephone($executive_director_telephone);
				$organizations->setTrusteeID($directors_trustees_id);
				$organizations->setDirectorsTrusteesFullname($directors_trustees_fullname);
				$organizations->setDirectorsTrusteesTelephone($directors_trustees_telephone);
				$organizations->setDirectorsTrusteesEmail($directors_trustees_email);
				$organizations->setDirectorsTrusteesOccupation($directors_trustees_occupation);
				$organizations->setDirectorsTrusteesNationality($directors_trustees_nationality);
				$organizations->setDirectorsTrusteesNationalID($directors_trustees_national_id);
				$organizations->setDirectorsTrusteesPosition($directors_trustees_position);
				$organizations->setDirectorsTrusteesTimeframe($directors_trustees_timeframe);
				
				// accounting
				$organizations->setFinancialYearStartMonth($financial_year_start_month);
				$organizations->setFinancialYearEndMonth($financial_year_end_month);
				$organizations->setSourceFundingID($source_funding_id);
				$organizations->setSourceFundingDonorID($source_funding_donor_id);
				$organizations->setSourceFundingContactDetails($source_funding_contact_details);
				$organizations->setSourceFundingCurrency($source_funding_currency);
				$organizations->setSourceFundingAmount($source_funding_amount);
				$organizations->setAuditorID($auditor_id);
				$organizations->setAuditorName($auditor_name);
				$organizations->setAuditorAddress($auditor_address);
				$organizations->setAuditorTelephone($auditor_telephone);
				$organizations->setAuditorEmail($auditor_email);
				$organizations->setOrganizationBankID($organization_bank_id);
				$organizations->setBankID($bank_id);
				$organizations->setBankAddress($bank_address);
				$organizations->setBankTelephone($bank_telephone);
				$organizations->setBankEmail($bank_email);
				
				// temporary employment permit applications
				$organizations->setTEPID($tep_id);
				$organizations->setTEPFullname($tep_fullname);
				$organizations->setTEPNationality($tep_nationality);
				$organizations->setTEPPassportNumber($tep_passport_number);

				// no documents...documents are specific to a particular year's annual return
				
				// other	
				$organizations->setRecordControl($new_record_control);
				$organizations->setLastEditedBy($this->approved_by);
				$organizations->setAction($action);
				$organizations->setUserAction($user_action);
				$organizations->setUpdateAnnualReturnInfo($update_annual_return_info);
		
				$organizations->edit();
				
				$processing_result = (isset($_SESSION["message"])) ?  $_SESSION["message"] : "";
				$is_updated = (strpos(strtolower($processing_result), strtolower(MESSAGE_SUCCESS)) === false) ? false : true;

				if (!$is_updated) {
					// NGO was not successfully updated with the approved annual return info
					$message .= ". Organization could not be successfully updated with the approved annual return information: " . ucfirst($processing_result);
					$message_type = MESSAGE_INFORMATION_TYPE;
				}
			}
			
			$_SESSION["message"] = $message;
        	$_SESSION["message_type"] = $message_type;
        } else {
            $_SESSION["message"] = MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
        }
		
		// log the user activity
		audit_trail::log_trail(ucwords($this->action), $_SESSION["message"], $this->approved_by, "License", $this->licensing_organization_id);
	}
	
    /**
     * Delete annual return
     *
     */
    public function delete()
    {
        $conn = config::connect();
        $table_prefix = TABLE_PREFIX;

        // check if this annual return is in use
        $is_used = false;

        if ($is_used) {
            $_SESSION["message"] = "$this->reporting_year license request for '$this->organization_name'" . MESSAGE_IN_USE;
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }

        $sql = "UPDATE {$table_prefix}licensing_organization SET status = '". $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '";
		$sql .= $conn->real_escape_string($this->deleted_by) . "', " . "deleted_date = NOW() WHERE licensing_organization_id = '";
		$sql .= $conn->real_escape_string($this->licensing_organization_id) . "'";
 
        $result = $conn->query($sql);

        if ($result) {
			$log_data_activity = false;
			$action = "delete";
			$no_data = array();
			// 2. delete annual return data: organizational objectives
			self::processOrganizationData($this->licensing_organization_id, "objective", $no_data, $action, $this->deleted_by, $log_data_activity);

			// 3. delete annual return data: staff capacity
			self::processOrganizationData($this->licensing_organization_id, "staff capacity", $no_data, $action, $this->deleted_by, $log_data_activity);
										
			// 4. delete annual return data: sectors
			self::processOrganizationData($this->licensing_organization_id, "sector", $no_data, $action, $this->deleted_by, $log_data_activity);
			
			// 5. delete annual return data: location activities
			self::processOrganizationData($this->licensing_organization_id, "location activity", $no_data, $action, $this->deleted_by, $log_data_activity);	
											
			// 6. delete annual return data: target groups
			self::processOrganizationData($this->licensing_organization_id, "target group", $no_data, $action, $this->deleted_by, $log_data_activity);
			
			// 7. delete annual return data: directors/trustees
			self::processOrganizationData($this->licensing_organization_id, "trustee", $no_data, $action, $this->deleted_by, $log_data_activity);
								  
			// 8. delete annual return data: source of funding
			self::processOrganizationData($this->licensing_organization_id, "source funding", $no_data, $action, $this->deleted_by, $log_data_activity);

			// 9. delete annual return data: auditor's details 
			self::processOrganizationData($this->licensing_organization_id, "auditor", $no_data, $action, $this->deleted_by, $log_data_activity);
			
			// 10. delete annual return data: bank details
			self::processOrganizationData($this->licensing_organization_id, "bank", $no_data, $action, $this->deleted_by, $log_data_activity);
			
			// 11. delete annual return data: temporary employment permit applications
			self::processOrganizationData($this->licensing_organization_id, "tep", $no_data, $action, $this->deleted_by, $log_data_activity);
									  
			// 12. delete annual return data: documents
			$documents = self::getOrganizationData($this->licensing_organization_id, "document", "filename"); 
			self::processOrganizationDocuments($this->licensing_organization_id, $this->organization_id, $no_data, $documents, $action, $this->deleted_by, $log_data_activity);

            $_SESSION["message"] = "$this->reporting_year license request for '$this->organization_name'" . MESSAGE_SUCCESS . "deleted";
            $_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
        } else {
            $_SESSION["message"] = MESSAGE_ERROR;
            $_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
        }
		
		// log the user activity
		audit_trail::log_trail("Delete", $_SESSION["message"], $this->deleted_by, "License", $this->licensing_organization_id);
    }
	
 	/**
	 * List all annual returns
	 *
	 * @param string organization_id
	 * @param string record_control
	 * @param string status
	 * @param string licensing_organization_id
	 *
 	 * @return array of annual returns
	 */
	public static function all($organization_id = "", $record_control = "", $status = STATUS_ACTIVE, $licensing_organization_id = "") 
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		$licensing_organizations = array();
		$sql = "SELECT * FROM {$table_prefix}licensing_organization WHERE status IN ('$status') ";
		if (strlen($organization_id) > 0) $sql .= "AND organization_id IN ('$organization_id') ";
		if (strlen($record_control) > 0) $sql .= "AND record_control IN ('$record_control') ";
		if (strlen($licensing_organization_id) > 0) $sql .= "AND licensing_organization_id IN ('$licensing_organization_id') ";
		$sql .= "ORDER BY reporting_year DESC, organization_name";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$licensing_organizations[] = $row;
		}
		return $licensing_organizations;
	}
	
	/**
     * Process annual return organization data
	 *
	 * @param string licensing_organization_id
	 * @param string data_category
	 * @param array data_1
	 * @param string action
	 * @param string captured_by
	 * @param boolean log_activity
	 * @param array data_2
	 * @param array data_3
	 * @param array data_4
	 * @param array data_5
	 * @param array data_6
	 * @param array data_7
	 * @param array data_8
	 * @param array data_9
	 * 
	 */
    public static function processOrganizationData($licensing_organization_id, $data_category, $data_1, $action, $captured_by, $log_activity = true, $data_2 = array(),
												   $data_3 = array(), $data_4 = array(), $data_5 = array(), $data_6 = array(), $data_7 = array(), $data_8 = array(), 
												   $data_9 = array())
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

        if (empty($data_1) && $action === "submit") {
            $_SESSION["message"] = "Please enter $data_category";
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }
		
		$fields = array();
		
		if (in_array($data_category, array("objective", "sector", "target group")))	$fields = array(str_replace(" ", "_", $data_category));
		elseif ($data_category === "staff capacity") $fields = array("staff_type", "staff_number");
		elseif ($data_category === "location activity") $fields = array("vdc", "adc", "district_id");		
		elseif ($data_category === "trustee") $fields = array("fullname", "telephone", "email", "occupation", "nationality", "national_id", "position", "timeframe");
		elseif ($data_category === "source funding") $fields = array("donor_id", "contact_details", "funding_currency", "funding_amount", "funding_amount_local");
		elseif ($data_category === "auditor") $fields = array("name", "address", "telephone", "email");
		elseif ($data_category === "bank") $fields = array("bank_id", "address", "telephone", "email");
		elseif ($data_category === "tep") $fields = array("fullname", "nationality", "passport_number");
		
		$table_part = str_replace(" ", "_", $data_category);
		$table_name = "licensing_organization_$table_part";
		$table_id = ($data_category === "bank") ? "organization_$table_part" . "_id" : $table_part . "_id";		
		
		$first_array_has_data = true;
		if ($action === "submit") {
			$sql = "INSERT INTO {$table_prefix}$table_name (licensing_organization_id, " . implode(", ", $fields) . ", captured_by, ";
			$sql .= "captured_date, status) VALUES ";
			$first_array_has_data = false;
		} elseif ($action === "edit") {
			$sql = "";
		} elseif ($action === "delete") {
			// delete annual return organization data
			$sql = "UPDATE {$table_prefix}$table_name SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '";
			$sql .= $conn->real_escape_string($captured_by) . "', deleted_date = NOW() WHERE status <> '" . $conn->real_escape_string(STATUS_DELETED) . "' AND ";
			$sql .= "licensing_organization_id = '" . $conn->real_escape_string($licensing_organization_id) . "'";
			// remove 'e' so that the past tense message to the user should make sense i.e. 'deleted' not 'deleteed'
			$action = "delet";
		}
			
		$count_1 = count($data_1);
		$i = 0;
		foreach ($data_1 as $d) :
			if ($action === "submit") {
				// ensure theres data in the first array
				if (strlen(trim($d)) > 0) {
					$first_array_has_data = true;
					$sql .= "('" . $conn->real_escape_string($licensing_organization_id) . "', '" . $conn->real_escape_string($d) . "', '";
					
					if (!empty($data_2)) {
						$field_value = (array_key_exists($i, $data_2)) ? $data_2[$i] : "";
						$sql .= $conn->real_escape_string($field_value) . "', '";
					}
					
					if (!empty($data_3)) {
						$field_value = (array_key_exists($i, $data_3)) ? $data_3[$i] : "";
						$sql .= $conn->real_escape_string($field_value) . "', '";
					}			
					
					if (!empty($data_4)) {
						$field_value = (array_key_exists($i, $data_4)) ? $data_4[$i] : "";
						$sql .= $conn->real_escape_string($field_value) . "', '";
						
						if ($data_category === "source funding") {
							// calculate funding in local currency
							$funding_currency = $data_3[$i];
							$exchange_rate = common::getFieldValue("currency", "exchange_rate", "currency", $funding_currency);
							$funding_amount = $data_4[$i];
							$funding_amount_local = $funding_amount * $exchange_rate;
		
							$sql .= $conn->real_escape_string($funding_amount_local) . "', '";
						}
					}			
					
					if (!empty($data_5)) {
						$field_value = (array_key_exists($i, $data_5)) ? $data_5[$i] : "";
						$sql .= $conn->real_escape_string($field_value) . "', '";
					}			
					
					if (!empty($data_6)) {
						$field_value = (array_key_exists($i, $data_6)) ? $data_6[$i] : "";
						$sql .= $conn->real_escape_string($field_value) . "', '";
					}			
					
					if (!empty($data_7)) {
						$field_value = (array_key_exists($i, $data_7)) ? $data_7[$i] : "";
						$sql .= $conn->real_escape_string($field_value) . "', '";
					}	
					
					if (!empty($data_8)) {
						$field_value = (array_key_exists($i, $data_8)) ? $data_8[$i] : "";
						$sql .= $conn->real_escape_string($field_value) . "', '";
					}		
				
					$sql .= $conn->real_escape_string($captured_by) . "', NOW(), '";
					$sql .= $conn->real_escape_string(STATUS_ACTIVE) . "')";
					$i++;
					if ($i <= $count_1 - 1) $sql .= ", ";
				}
			} elseif ($action === "edit") {
				// edit annual return orgnaization data
				$sql .= "UPDATE {$table_prefix}$table_name SET $fields[0] = '" . $conn->real_escape_string($d) . "', ";				
				if (!empty($data_3)) $sql .= "$fields[1] = '" . $conn->real_escape_string($data_3[$i]) . "', ";
				if (!empty($data_4)) $sql .= "$fields[2] = '" . $conn->real_escape_string($data_4[$i]) . "', ";
				if (!empty($data_5)) {
					$sql .= "$fields[3] = '" . $conn->real_escape_string($data_5[$i]) . "', ";				
					if ($data_category === "source funding") {
						// calculate funding in local currency
						$funding_currency = $data_4[$i];
						$exchange_rate = common::getFieldValue("currency", "exchange_rate", "currency", $funding_currency);
						$funding_amount = $data_5[$i];
						$funding_amount_local = $funding_amount * $exchange_rate;	
						$sql .= "$fields[4] = '" . $conn->real_escape_string($funding_amount_local) . "', ";
					}
				}					
				if (!empty($data_6)) $sql .= "$fields[4] = '" . $conn->real_escape_string($data_6[$i]) . "', ";
				if (!empty($data_7)) $sql .= "$fields[5] = '" . $conn->real_escape_string($data_7[$i]) . "', ";
				if (!empty($data_8)) $sql .= "$fields[6] = '" . $conn->real_escape_string($data_8[$i]) . "', ";
				if (!empty($data_9)) $sql .= "$fields[7] = '" . $conn->real_escape_string($data_9[$i]) . "', ";
				
				$sql .= "last_edited_by = '" . $conn->real_escape_string($captured_by) . "', last_edited_date = NOW() WHERE licensing_organization_id = '";
				$sql .= $conn->real_escape_string($licensing_organization_id) . "' AND $table_id = '" . $conn->real_escape_string($data_2[$i]) . "';";
				
				$i++;

				if ($i == $count_1) {
					// delete annual return data
					$sql .= "UPDATE {$table_prefix}$table_name SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '";
					$sql .= $conn->real_escape_string($captured_by) . "', deleted_date = NOW() WHERE status <> '" . $conn->real_escape_string(STATUS_DELETED) . "' AND ";
					$sql .= "licensing_organization_id = '" . $conn->real_escape_string($licensing_organization_id) . "' AND $table_id NOT IN ('" . implode("', '", $data_2)."');";
				}
			}
		endforeach;

		$result = ($first_array_has_data) ? $conn->multi_query($sql) : true;
		
		if ($result) {
			$_SESSION["message"] = "Annual return data '$data_category'" . MESSAGE_SUCCESS . "$action" . "ed";
			$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
		} else {
			$_SESSION["message"] = MESSAGE_ERROR;
			$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
		}
		
		// log the user activity
		if ($log_activity) audit_trail::log_trail("Save Details", $_SESSION["message"], $captured_by, "License" . ucwords($data_category), $licensing_organization_id);
	}
	
	/**
     * Process annual return organization documents
	 *
	 * @param string licensing_organization_id
	 * @param string organization_id
	 * @param string abbreviation
	 * @param string action
	 * @param string captured_by
	 * @param string reporting_year
	 * @param boolean log_activity
	 * 
	 */
    public static function processOrganizationDocuments($licensing_organization_id, $organization_id, $documents, $action, $captured_by, $reporting_year, $log_activity = true)
	{
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;

		global $DOC_FILE_EXT;

		// set the maximum execution time to 60 seconds
        set_time_limit(60);

		// set the default time zone to be that for Malawi
		date_default_timezone_set("Africa/Blantyre");
		
        if (empty($documents)) {
            $_SESSION["message"] = "No document was uploaded. Please upload document(s)";
            $_SESSION["message_type"] = MESSAGE_INFORMATION_TYPE;
            return;
        }

		if ($action === "submit" || $action === "edit") {
			// loop through the documents to be uploaded
			foreach ($documents as $document_category => $document) :
				// if the document has been chosen, proceed
				if (isset($document["name"])) { 
					$document_size = $document["size"];
					$document_size_MB = $document_size / 1024 / 1024;
					$document_name = $document["name"];
					$document_type = $document["type"];
					$document_tmp = $document["tmp_name"];
					$document_ext = explode(".", $document_name); $document_ext = strtolower(end($document_ext));
	
					// if the document size is greater than zero, proceed
					if ($document_size > 0 && strlen(trim($document_name)) > 0) {
						// if the document size is less than the recommended size, proceed
						if ($document_size_MB <= MAX_FILE_IMPORT_SIZE) {
							// if the document extension is the correct one (docx, doc and pdf), proceed
							if (in_array($document_ext, $DOC_FILE_EXT)) {
								// define the path where the document should be saved
								$path = DOCUMENT_UPLOAD_PATH;
	
								// naming conversion of the new document: organization_id-document_category-reporting_year.extension 
								// e.g. FTC-1-annual-technical-report-2020.pdf
								$new_document_name = strtolower(str_replace(" ", "-", "$organization_id-$document_category-$reporting_year.$document_ext"));
	
								// get the old document name
								$old_document_name = common::getFieldValue("licensing_organization_document", "filename", "licensing_organization_id", $licensing_organization_id,
																		   "document_category", $document_category);
								// delete the old document if it exists
								if (strlen($old_document_name) > 0 && file_exists($path . $old_document_name))
									unlink($path . $old_document_name);
									
								if ($action === "submit" || strlen($old_document_name) == 0) {
									// this is a 'submit' action or there was no old document...insert the new information into the database
									$sql = "INSERT INTO {$table_prefix}licensing_organization_document (licensing_organization_id, document_category, filename, captured_by, ";
									$sql .= "captured_date, status) VALUES ('" . $conn->real_escape_string($licensing_organization_id) . "', '";
									$sql .= $conn->real_escape_string($document_category) . "', '" . $conn->real_escape_string($new_document_name) . "', '";
									$sql .= $conn->real_escape_string($captured_by) . "', NOW(), '" . $conn->real_escape_string(STATUS_ACTIVE) . "')";
								} elseif ($action === "edit") {
									// this is an 'edit' action...do nothing, the document information is already in the database...
									// just define s dumpy SQL statement which will be successful when executed i.e. result = true
									$sql = "SELECT 1";
								}		
								
								$result = $conn->query($sql);

								if ($result) {
									// upload document
									move_uploaded_file($document_tmp, $path . $new_document_name);
								
									$message = "Annual return document '$document_name'" . MESSAGE_SUCCESS . "uploaded";
									$message_type = MESSAGE_SUCCESS_TYPE;
								} else {
									$message = MESSAGE_ERROR;
									$message_type = MESSAGE_ERROR_TYPE;
								}
							} else {
								// wrong document type						
								$message = "Invalid document format. Please upload files of type " . implode(", ", $DOC_FILE_EXT);
								$message_type = MESSAGE_ERROR_TYPE;
							}
						} else {
							// document size exceeded
							$message = "Document size limit exceeded (" . MAX_FILE_IMPORT_SIZE . "MB)";
							$message_type = MESSAGE_ERROR_TYPE;
						}
				   } else {	
						// document size <= 0				
						$error_code = $document["error"];
		
						if ($error_code === UPLOAD_ERR_INI_SIZE || $error_code === UPLOAD_ERR_FORM_SIZE || $document_size_MB > MAX_FILE_IMPORT_SIZE)
							$error = "Document size limit exceeded (" . MAX_FILE_IMPORT_SIZE . "MB)";
						elseif ($error_code === UPLOAD_ERR_PARTIAL)						
							$error = "The uploaded document(s) were only partially uploaded";
						else
							$error = "No document was uploaded. Please upload document(s)";
									  
						$message = $error;
						$message_type = MESSAGE_ERROR_TYPE;
					}
				} else {
					// $document["name"]) not set 
					$message = "No document was uploaded. Please upload document(s)";					              
					$message_type = MESSAGE_ERROR_TYPE;
				}
				$_SESSION["message"] = $message;
				$_SESSION["message_type"] = $message_type;
			endforeach;
		} elseif ($action === "delete") {
			// delete annual return organization documents
			$sql = "UPDATE {$table_prefix}licensing_organization_document SET status = '" . $conn->real_escape_string(STATUS_DELETED) . "', deleted_by = '";
			$sql .= $conn->real_escape_string($captured_by) . "', deleted_date = NOW() WHERE status <> '" . $conn->real_escape_string(STATUS_DELETED) . "' AND ";
			$sql .= "licensing_organization_id = '" . $conn->real_escape_string($licensing_organization_id) . "'";
			
			$result = $conn->query($sql);
			
			if ($result) {
				// delete the files from the file directory
				foreach ($documents as $key => $document) :
					if (strlen($document->filename) > 0 && file_exists(DOCUMENT_UPLOAD_PATH . $document->filename))
						unlink(DOCUMENT_UPLOAD_PATH . $document->filename);
				endforeach;
								
				$message = "Annual return documents" . MESSAGE_SUCCESS . "deleted";
				$_SESSION["message"] = $message;
				$_SESSION["message_type"] = MESSAGE_SUCCESS_TYPE;
			} else {
				$message = MESSAGE_ERROR;
				$_SESSION["message"] = $message;
				$_SESSION["message_type"] = MESSAGE_ERROR_TYPE;
			}			
		}
		
		// log the user activity
		if ($log_activity) audit_trail::log_trail("Save Details", $message, $captured_by, "License Document", $licensing_organization_id);
	}
	
	/**
	 * List all annual return organization data
	 *
	 * @param string licensing_organization_id
	 * @param string data_category
	 * @param string fields
	 * @param string status
	 *
 	 * @return array of annual return organization data
	 */
	public static function getOrganizationData($licensing_organization_id, $data_category, $fields = "*", $status = STATUS_ACTIVE) 	
	{									
		$conn = config::connect();
		$table_prefix = TABLE_PREFIX;
		
		$organization_data = array();
		$table_part = str_replace(" ", "_", $data_category);
		$table_id = $table_part . "_id";
		if ($data_category === "bank") $table_id = "organization_$table_id";
		
		$sql = "SELECT $fields FROM {$table_prefix}licensing_organization_$table_part WHERE status IN ('$status') AND ";
		$sql .= "licensing_organization_id IN ('$licensing_organization_id') ORDER BY $table_id";

		$result = $conn->query($sql);

		while ($row = $result->fetch_object()) {
			$organization_data[] = $row;
		}
		return $organization_data;
	}
}