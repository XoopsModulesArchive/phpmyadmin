<?php

/* $Id: sqlvalidator.class.php,v 2.2 2003/11/26 22:52:23 rabus Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * PHP interface to MimerSQL Validator
 *
 * Copyright 2002, 2003 Robin Johnson <robbat2@users.sourceforge.net>
 * http://www.orbis-terrarum.net/?l=people.robbat2
 *
 * All data is transported over HTTP-SOAP
 * And uses the PEAR SOAP Module
 *
 * Install instructions for PEAR SOAP
 * Make sure you have a really recent PHP with PEAR support
 * run this: "pear install Mail_Mime Net_DIME SOAP"
 *
 * If you got this file from somewhere other than phpMyAdmin
 * please be aware that the latest copy will always be in the
 * phpMyAdmin CVS tree as
 * $Source: /cvsroot/phpmyadmin/phpMyAdmin/libraries/sqlvalidator.class.php,v $
 *
 * This code that also used to depend on the PHP overload module, but that has been
 * removed now.
 *
 *
 * @author   Robin Johnson <robbat2@users.sourceforge.net>
 *
 * @version  $Id: sqlvalidator.class.php,v 2.2 2003/11/26 22:52:23 rabus Exp $
 */
@require_once __DIR__ . '/SOAP/Client.php';

if (!function_exists('class_exists') || !class_exists('SOAP_Client')) {
    $GLOBALS['sqlvalidator_error'] = true;
} else {
    // Ok, we have SOAP Support, so let's use it!

    class PMA_SQLValidator
    {
        public $url;

        public $service_name;

        public $wsdl;

        public $output_type;

        public $username;

        public $password;

        public $calling_program;

        public $calling_program_version;

        public $target_dbms;

        public $target_dbms_version;

        public $connectionTechnology;

        public $connection_technology_version;

        public $interactive;

        public $service_link = null;

        public $session_data = null;

        /**
         * Private functions - You don't need to mess with these
         * @param mixed $url
         */

        /**
         * Service opening
         *
         * @param  string $url  URL of Mimer SQL Validator WSDL file
         *
         * @return object  Object to use
         */
        public function _openService($url)
        {
            $obj = new SOAP_Client($url, true);

            return $obj;
        }

        // end of the "openService()" function

        /**
         * Service initializer to connect to server
         *
         * @param mixed $obj
         * @param mixed $username
         * @param mixed $password
         * @param mixed $calling_program
         * @param mixed $calling_program_version
         * @param mixed $target_dbms
         * @param mixed $target_dbms_version
         * @param mixed $connection_technology
         * @param mixed $connection_technology_version
         * @param mixed $interactive
         *
         * @return object   stdClass return object with data
         */
        public function _openSession(
            $obj,
            $username,
            $password,
            $calling_program,
            $calling_program_version,
            $target_dbms,
            $target_dbms_version,
            $connection_technology,
            $connection_technology_version,
            $interactive
        ) {
            $use_array = [ 'a_userName' => $username, 'a_password' => $password, 'a_callingProgram' => $calling_program, 'a_callingProgramVersion' => $calling_program_version, 'a_targetDbms' => $target_dbms, 'a_targetDbmsVersion' => $target_dbms_version, 'a_connectionTechnology' => $connection_technology, 'a_connectionTechnologyVersion' => $connection_technology_version, 'a_interactive' => $interactive];

            $ret = $obj->call('openSession', $use_array);

            // This is the old version that needed the overload extension

            /* $ret = $obj->openSession($username, $password,
                                      $calling_program, $calling_program_version,
                                      $target_dbms, $target_dbms_version,
                                      $connection_technology, $connection_technology_version,
                                      $interactive); */

            return $ret;
        }

        // end of the "_openSession()" function

        /**
         * Validator sytem call
         *
         * @param mixed $obj
         * @param mixed $session
         * @param mixed $sql
         * @param mixed $method
         *
         * @return object  stClass return with data
         */
        public function _validateSQL($obj, $session, $sql, $method)
        {
            $use_array = ['a_sessionId' => $session->sessionId, 'a_sessionKey' => $session->sessionKey, 'a_SQL' => $sql, 'a_resultType' => $this->output_type];

            $res = $obj->call('validateSQL', $use_array);

            // This is the old version that needed the overload extension

            // $res = $obj->validateSQL($session->sessionId, $session->sessionKey, $sql, $this->output_type);

            return $res;
        }

        // end of the "validateSQL()" function

        /**
         * Validator sytem call
         *
         * @param mixed $sql
         *
         * @return object  stdClass return with data
         *
         * @see    validateSQL()
         */
        public function _validate($sql)
        {
            $ret = $this->_validateSQL(
                $this->service_link,
                $this->session_data,
                $sql,
                $this->output_type
            );

            return $ret;
        }

        // end of the "validate()" function

        /**
         * Public functions
         */

        /**
         * Constructor
         */
        public function __construct()
        {
            $this->url = 'http://sqlvalidator.mimer.com/v1/services';

            $this->service_name = 'SQL99Validator';

            $this->wsdl = '?wsdl';

            $this->output_type = 'html';

            $this->username = 'anonymous';

            $this->password = '';

            $this->calling_program = 'PHP_SQLValidator';

            $this->calling_program_version = '$Revision: 2.2 $';

            $this->target_dbms = 'N/A';

            $this->target_dbms_version = 'N/A';

            $this->connection_technology = 'PHP';

            $this->connection_technology_version = phpversion();

            $this->interactive = 1;

            $this->service_link = null;

            $this->session_data = null;
        }

        // end of the "PMA_SQLValidator()" function

        /**
         * Sets credentials
         *
         * @param mixed $username
         * @param mixed $password
         */
        public function setCredentials($username, $password)
        {
            $this->username = $username;

            $this->password = $password;
        }

        // end of the "setCredentials()" function

        /**
         * Sets the calling program
         *
         * @param mixed $calling_program
         * @param mixed $calling_program_version
         */
        public function setCallingProgram($calling_program, $calling_program_version)
        {
            $this->calling_program = $calling_program;

            $this->calling_program_version = $calling_program_version;
        }

        // end of the "setCallingProgram()" function

        /**
         * Appends the calling program
         *
         * @param mixed $calling_program
         * @param mixed $calling_program_version
         */
        public function appendCallingProgram($calling_program, $calling_program_version)
        {
            $this->calling_program .= ' - ' . $calling_program;

            $this->calling_program_version .= ' - ' . $calling_program_version;
        }

        // end of the "appendCallingProgram()" function

        /**
         * Sets the target DBMS
         *
         * @param mixed $target_dbms
         * @param mixed $target_dbms_version
         */
        public function setTargetDbms($target_dbms, $target_dbms_version)
        {
            $this->target_dbms = $target_dbms;

            $this->target_dbms_version = $target_dbms_version;
        }

        // end of the "setTargetDbms()" function

        /**
         * Appends the target DBMS
         *
         * @param mixed $target_dbms
         * @param mixed $target_dbms_version
         */
        public function appendTargetDbms($target_dbms, $target_dbms_version)
        {
            $this->target_dbms .= ' - ' . $target_dbms;

            $this->target_dbms_version .= ' - ' . $target_dbms_version;
        }

        // end of the "appendTargetDbms()" function

        /**
         * Sets the connection technology used
         *
         * @param mixed $connection_technology
         * @param mixed $connection_technology_version
         */
        public function setConnectionTechnology($connection_technology, $connection_technology_version)
        {
            $this->connection_technology = $connection_technology;

            $this->connection_technology_version = $connection_technology_version;
        }

        // end of the "setConnectionTechnology()" function

        /**
         * Appends the connection technology used
         *
         * @param mixed $connection_technology
         * @param mixed $connection_technology_version
         */
        public function appendConnectionTechnology($connection_technology, $connection_technology_version)
        {
            $this->connection_technology .= ' - ' . $connection_technology;

            $this->connection_technology_version .= ' - ' . $connection_technology_version;
        }

        // end of the "appendConnectionTechnology()" function

        /**
         * Sets whether interactive mode should be used or not
         *
         * @param mixed $interactive
         */
        public function setInteractive($interactive)
        {
            $this->interactive = $interactive;
        }

        // end of the "setInteractive()" function

        /**
         * Sets the output type to use
         *
         * @param mixed $output_type
         */
        public function setOutputType($output_type)
        {
            $this->output_type = $output_type;
        }

        // end of the "setOutputType()" function

        /**
         * Starts service
         */
        public function startService()
        {
            $this->service_link = $this->_openService($this->url . '/' . $this->service_name . $this->wsdl);
        }

        // end of the "startService()" function

        /**
         * Starts session
         */
        public function startSession()
        {
            $this->session_data = $this->_openSession(
                $this->service_link,
                $this->username,
                $this->password,
                $this->calling_program,
                $this->calling_program_version,
                $this->target_dbms,
                $this->target_dbms_version,
                $this->connection_technology,
                $this->connection_technology_version,
                $this->interactive
            );

            if (isset($this->session_data) && (null != $this->session_data)
                && ($this->session_data->target != $this->url)) {
                // Reopens the service on the new URL that was provided

                $url = $this->session_data->target;

                $this->startService();
            }
        }

        // end of the "startSession()" function

        /**
         * Do start service and session
         */
        public function start()
        {
            $this->startService();

            $this->startSession();
        }

        // end of the "start()" function

        /**
         * Call to determine just if a query is valid or not.
         *
         * @param mixed $sql
         *
         * @return string Validator string from Mimer
         *
         * @see _validate
         */
        public function isValid($sql)
        {
            $res = $this->_validate($sql);

            return $res->standard;
        }

        // end of the "isValid()" function

        /**
         * Call for complete validator response
         *
         * @param mixed $sql
         *
         * @return string Validator string from Mimer
         *
         * @see _validate
         */
        public function validationString($sql)
        {
            $res = $this->_validate($sql);

            return $res->data;
        }

        // end of the "validationString()" function
    } // end class PMA_SQLValidator

    //add an extra check to ensure that the class was defined without errors

    if (!class_exists('PMA_SQLValidator')) {
        $GLOBALS['sqlvalidator_error'] = true;
    }
} // end else
