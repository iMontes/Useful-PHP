<?php
/**
 * Makes a random key with the specified length.
 *
 * @param int $length
 * @return string
 */
function makeKey($length)
{
    $seed = "0123456789abcdefghijklmnopqrstuvwxyz";
    $len = strlen($seed);
    $key = "";

    for ($i=0; $i<$length; $i++) {
        $key .= $seed[ rand(0, $len-1) ];
    }

    return $key;

}


/**
 * Get Remote IP Address
 *
 * @return string
 */
function getRealIPAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


/**
 * Browser detection script
 *
 * @return string
 */
function useragent() {
    return $_SERVER ['HTTP_USER_AGENT'];  
}


/**
 * Directory Listing
 *
 */
function list_files($dir)
{
    if(is_dir($dir))
    {
        if($handle = opendir($dir))
        {
            while(($file = readdir($handle)) !== false)
            {
                if($file != "." && $file != ".." && $file != "Thumbs.db"/*pesky windows, images..*/)
                {
                    echo '<a target="_blank" href="'.$dir.$file.'">'.$file.'</a><br>'."\n";
                }
            }
            closedir($handle);
        }
    }
}


/**
 * Destroy directory
 *
 * @param string $dir Directory to destroy
 * @param boolean $virtual Whether a virtual directory
 * @return bool
 */
function destroyDir($dir, $virtual = false)
{
    $ds = DIRECTORY_SEPARATOR;
    $dir = $virtual ? realpath($dir) : $dir;
    $dir = substr($dir, -1) == $ds ? substr($dir, 0, -1) : $dir;
    if (is_dir($dir) && $handle = opendir($dir))
    {
        while ($file = readdir($handle))
        {
            if ($file == '.' || $file == '..')
            {
                continue;
            }
            elseif (is_dir($dir.$ds.$file))
            {
                destroyDir($dir.$ds.$file);
            }
            else
            {
                unlink($dir.$ds.$file);
            }
        }
        closedir($handle);
        rmdir($dir);
        return true;
    }
    else
    {
        return false;
    }
}
?>