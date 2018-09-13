<?php

class Installer {

	private $extensions = array(
		array('name' => 'fileinfo', 'type' => 'extension', 'expected' => true),
		array('name' => 'mbstring', 'type' => 'extension', 'expected' => true),
		array('name' => 'pdo', 'type' => 'extension', 'expected' => true),
		array('name' => 'pdo_mysql', 'type' => 'extension', 'expected' => true),
		array('name' => 'gd', 'type' => 'extension', 'expected' => true),
		array('name' => 'Mcrypt', 'type' => 'extension', 'expected' => true),
		array('name' => 'mysql_real_escape_string', 'type' => 'extension', 'expected' => false),
		array('name' => 'curl', 'type' => 'extension', 'expected' => true),
		array('name' => 'putenv', 'type' => 'function', 'expected' => true),
		array('name' => 'getenv', 'type' => 'function', 'expected' => true),
	);

	private $dirs = array('/config', '/storage/logs', '/storage/framework/cache', '/storage/framework/views', '/storage/framework/sessions');

	private $compatResults = array('problem' => false);

    public function __construct() {
        if (strpos($_SERVER['REQUEST_URI'], 'htaccess-test') > -1) {
            echo 'success'; exit;
        }

        $post = json_decode(file_get_contents('php://input'), true);
        $data = isset($post['data']) ? $post['data'] : array();

        if ($post && array_key_exists('handler', $post)) {
        	set_error_handler(function($severity, $message) {
        		echo json_encode(array('status' => 'error', 'message'=> $message));
        		exit;
        	});

        	try {
        		$this->{$post['handler']}($data);
        		restore_error_handler();
        	} catch (Exception $e) {
        		echo json_encode(array('status' => 'error', 'message'=> $e->getMessage()));
        		exit;
        	}
        }
    }

	public function checkForIssues() {
		$this->compatResults['extensions'] = $this->checkExtensions();
		$this->compatResults['folders']    = $this->checkFolders();
		$this->compatResults['phpVersion'] = $this->checkPhpVersion();

		return json_encode($this->compatResults);
	}

	public function checkPhpVersion() {
		return version_compare(PHP_VERSION, '7.1.20');
	}

	public function checkFolders() {
		$checked = array();

		foreach ($this->dirs as $dir)
		{
            $path = SYSTEM_PATH.$dir;

		 	$writable = is_writable($path);

		 	$checked[] = array('path' => realpath($path), 'writable' => $writable);

		 	if ( ! $this->compatResults['problem']) {
		 		$this->compatResults['problem'] = $writable ? false : true;
		 	}
		}

		return $checked;
	}

	private function checkExtensions()
	{
		$problem = false;

		foreach ($this->extensions as $k => &$ext)
		{
			if ($ext['type'] === 'function') {
                $loaded = function_exists($ext['name']);
            } else {
                $loaded = extension_loaded($ext['name']);
            }
			if ($loaded !== $ext['expected'])
			{
				$problem = true;
			}

			$ext['actual'] = $loaded;
		}

		$this->compatResults['problem'] = $problem;

		return $this->extensions;
	}

    private function validateDbCredentials($input)
    {
        $credentials = array_merge(array(
            'host'     => null,
            'database' => null,
            'username' => null,
            'password' => null,
            'hostAuth' => null,
            'databaseAuth' => null,
            'usernameAuth' => null,
            'passwordAuth' => null,
            'hostCharacters'     => null,
            'databaseCharacters' => null,
            'usernameCharacters' => null,
            'passwordCharacters' => null,
        ), $input);

        $db =  'mysql:host='.$credentials['host'].';dbname='.$credentials['database'];
        $dbAuth =  'mysql:host='.$credentials['hostAuth'].';dbname='.$credentials['databaseAuth'];
        $dbCharacters =  'mysql:host='.$credentials['hostCharacters'].';dbname='.$credentials['databaseCharacters'];

        try {
            $db = new PDO($db, $credentials['username'], $credentials['password'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch(PDOException $e) {
            return $e->getMessage();
        }
        try {
            $dbAuth = new PDO($dbAuth, $credentials['usernameAuth'], $credentials['passwordAuth'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch(PDOException $e) {
            return $e->getMessage();
        }
        try {
            $dbCharacters = new PDO($dbCharacters, $credentials['usernameCharacters'], $credentials['passwordCharacters'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

	public function createDb($input) {
        if ($message = $this->validateDbCredentials($input)) {
            echo json_encode(array('status' => 'error', 'message' => $message)); exit;
        }
        $this->insertDBCredentials($input);
        echo json_encode(array('status' => 'success')); exit;
	}

	public function createInfo($input) {
        $this->insertInfoServer($input);
        $this->putAppInProductionEnv();
        echo json_encode(array('status' => 'success')); exit;
	}

	private function insertInfoServer($input) {
        $credentials = array_merge(array(
            'name'     => null,
            'paypal_email' => null,
            'soap_host' => null,
            'password' => null,
            'soap_port' => null,
            'soap_username' => null,
            'soap_password' => null,
            'mail_driver' => null,
            'mail_host'     => null,
            'mail_port' => null,
            'mail_username' => null,
            'mail_password' => null,
        ), $input);

        $content = file_get_contents(SYSTEM_PATH . 'env.example');
        $content = preg_replace("/(.*?APP_NAME=)(.*?)\\n/msi", '${1}'.$credentials['name']."\n", $content);
        $content = preg_replace("/(.*?PAYPAL_EMAIL=)(.*?)\\n/msi", '${1}'.$credentials['paypal_email']."\n", $content);
        ///$content = preg_replace("/(.*?APP_URL=)(.*?)\\n/msi", '${1}'.url()."\n", $content);
        $content = preg_replace("/(.*?SOAP_HOST=)(.*?)\\n/msi", '${1}'.$credentials['soap_host']."\n", $content);
        $content = preg_replace("/(.*?SOAP_PORT=)(.*?)\\n/msi", '${1}'.$credentials['soap_port']."\n", $content);
        $content = preg_replace("/(.*?SOAP_USERNAME=)(.*?)\\n/msi", '${1}'.$credentials['soap_username']."\n", $content);
        $content = preg_replace("/(.*?SOAP_PASSWORD=)(.*?)\\n/msi", '${1}'.$credentials['soap_password']."\n", $content);
        $content = preg_replace("/(.*?MAIL_DRIVER=)(.*?)\\n/msi", '${1}'.$credentials['mail_driver']."\n", $content);
        $content = preg_replace("/(.*?MAIL_HOST=)(.*?)\\n/msi", '${1}'.$credentials['mail_host']."\n", $content);
        $content = preg_replace("/(.*?MAIL_PORT=)(.*?)\\n/msi", '${1}'.$credentials['mail_port']."\n", $content);
        $content = preg_replace("/(.*?MAIL_USERNAME=)(.*?)\\n/msi", '${1}'.$credentials['mail_username']."\n", $content);
        $content = preg_replace("/(.*?MAIL_PASSWORD=)(.*?)\\n/msi", '${1}'.$credentials['mail_password']."\n", $content);
        file_put_contents(SYSTEM_PATH . 'env.example', $content);
    }

	private function insertDBCredentials($input)
	{
        $credentials = array_merge(array(
            'host'     => null,
            'database' => null,
            'username' => null,
            'password' => null,
            'hostAuth' => null,
            'databaseAuth' => null,
            'usernameAuth' => null,
            'passwordAuth' => null,
            'hostCharacters'     => null,
            'databaseCharacters' => null,
            'usernameCharacters' => null,
            'passwordCharacters' => null,
        ), $input);

        $content = file_get_contents(SYSTEM_PATH . 'env.example');
        $content = preg_replace("/(.*?DB_HOST=)(.*?)\\n/msi", '${1}'.$credentials['host']."\n", $content);
        $content = preg_replace("/(.*?DB_DATABASE=)(.*?)\\n/msi", '${1}'.$credentials['database']."\n", $content);
        $content = preg_replace("/(.*?DB_USERNAME=)(.*?)\\n/msi", '${1}'.$credentials['username']."\n", $content);
        $content = preg_replace("/(.*?DB_PASSWORD=)(.*?)\\n/msi", '${1}'.$credentials['password']."\n", $content);
        $content = preg_replace("/(.*?DB_AUTH_HOST=)(.*?)\\n/msi", '${1}'.$credentials['hostAuth']."\n", $content);
        $content = preg_replace("/(.*?DB_AUTH_DATABASE=)(.*?)\\n/msi", '${1}'.$credentials['databaseAuth']."\n", $content);
        $content = preg_replace("/(.*?DB_AUTH_USERNAME=)(.*?)\\n/msi", '${1}'.$credentials['usernameAuth']."\n", $content);
        $content = preg_replace("/(.*?DB_AUTH_PASSWORD=)(.*?)\\n/msi", '${1}'.$credentials['passwordAuth']."\n", $content);
        $content = preg_replace("/(.*?DB_CHARACTERS_HOST=)(.*?)\\n/msi", '${1}'.$credentials['hostCharacters']."\n", $content);
        $content = preg_replace("/(.*?DB_CHARACTERS_DATABASE=)(.*?)\\n/msi", '${1}'.$credentials['databaseCharacters']."\n", $content);
        $content = preg_replace("/(.*?DB_CHARACTERS_USERNAME=)(.*?)\\n/msi", '${1}'.$credentials['usernameCharacters']."\n", $content);
        $content = preg_replace("/(.*?DB_CHARACTERS_PASSWORD=)(.*?)\\n/msi", '${1}'.$credentials['passwordCharacters']."\n", $content);
        file_put_contents(SYSTEM_PATH . 'env.example', $content);
	}

    private function finalizeInstallation() {
        $this->putAppInProductionEnv();
        rename(SYSTEM_PATH . 'env.example', SYSTEM_PATH . '.env');
        //try {
        //    $this->deleteInstallationFiles();
        //} catch (Exception $e) {}
        echo json_encode(array('status' => 'success', 'message' => 'success')); exit;
    }

    private function putAppInProductionEnv()
    {
        $content = file_get_contents(SYSTEM_PATH . 'env.example');
        $content = preg_replace("/(.*?INSTALLED=).*?(.+?)\\n/msi", '${1}true'."\n", $content);
        $content = preg_replace("/(.*?APP_ENV=).*?(.+?)\\n/msi", '${1}production'."\n", $content);
        $content = preg_replace("/(.*?APP_DEBUG=).*?(.+?)\\n/msi", '${1}false'."\n", $content);
        file_put_contents(SYSTEM_PATH . 'env.example', $content);
    }

    private function deleteInstallationFiles()
    {
        $dir = BASE_PATH.'/install_files';

        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);

        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }

        @rmdir($dir);

        @file_put_contents(BASE_PATH.'/index.php', str_replace("if (file_exists(__DIR__.'/install_files')) { require_once __DIR__.'/install_files/install.php'; exit; }", '', file_get_contents(BASE_PATH.'/index.php')));
    }

    private function testAndFixHtaccessFile()
    {
        $response = $this->htaccessTest();

        if ($response === 404 || $response === 500) {
            $this->htaccessAddSlash();

            $response = $this->htaccessTest();

            if ($response === 404 || $response === 500) {
                $this->htaccessRemoveSlash();

                $this->htaccessDisableMultiViews();

                $response = $this->htaccessTest();

                if ($response === 404 || $response === 500) {
                    $this->htaccessEnableMultiViews();
                    return (array('status' => 'error', 'message' => 'htacces error'));
                }

            }
        }

        return (array('status' => 'success', 'message' => 'success'));
    }

    private function htaccessDisableMultiViews()
    {
        $path = BASE_PATH.'/.htaccess';
        file_put_contents($path, str_replace('Options -MultiViews', '', file_get_contents($path)));
    }

    private function htaccessEnableMultiViews()
    {
        $path = BASE_PATH.'/.htaccess';
        $contents = file_get_contents($path);

        if (strrpos($contents, 'Options -MultiViews') === false) {
            file_put_contents($path, str_replace('<IfModule mod_negotiation.c>', "<IfModule mod_negotiation.c>\n\t\tOptions -MultiViews", $contents));
        }
    }

    private function htaccessAddSlash()
    {
        $path = BASE_PATH.'/.htaccess';
        file_put_contents($path, str_replace('RewriteRule ^ index.php [L]', 'RewriteRule ^ /index.php [L]', file_get_contents($path)));
    }

    private function htaccessRemoveSlash()
    {
        $path = BASE_PATH.'/.htaccess';
        file_put_contents($path, str_replace('RewriteRule ^ /index.php [L]', 'RewriteRule ^ index.php [L]', file_get_contents($path)));
    }

    private function htaccessTest()
    {
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]htaccess-test";

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_HEADER, true);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($handle, CURLOPT_TIMEOUT, 6);

        $response = curl_exec($handle);

        curl_close($handle);

        if (strpos($response, '404 Not Found') > -1) {
            return 404;
        }

        if (strpos($response, '500 Internal Server Error') > -1) {
            return 500;
        }

        return 'success';
    }

    public function handleHtaccessFile()
    {
        $path = SYSTEM_PATH.'public/.htaccess';

        if ( ! file_exists($path)) {
            $contents =
'<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews
    </IfModule>

    RewriteEngine On

    # Redirect Trailing Slashes...
            RewriteRule ^(.*)/$ /$1 [L,R=301]

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>';

        file_put_contents($path, $contents);

        }
    }
}