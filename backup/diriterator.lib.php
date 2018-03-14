<?php

class diriterator {
	

//https://davidhancock.co/2012/11/useful-php-functions-for-dealing-with-the-file-system/

/** 
 * Delete a file/recursively delete a directory
 *
 * NOTE: Be very careful with the path you pass to this!
 *
 * @param string $path The path to the file/directory to delete
 * @return void
 */
function delete_recursive($path)
{
    if (is_dir($path))
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
 
        foreach ($iterator as $file)
        {
            if ($file->isDir())
            {
                rmdir($file->getPathname());
            }
            else
            {
                unlink($file->getPathname());
            }
        }
 
        rmdir($path);
    }
    else
    {
        unlink($path);
    }
}

/**
 * Copy a file or recursively copy a directories contents
 *
 * @param string $source The path to the source file/directory
 * @param string $dest The path to the destination directory
 * @return void
 */
function copy_recursive($source, $dest)
{
    if (is_dir($source))
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $file)
        {
            if ($file->isDir())
            {
                mkdir($dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
            }
            else
            {
                copy($file, $dest.DIRECTORY_SEPARATOR.$iterator->getSubPathName());
            }
        }
    }
    else
    {
        copy($source, $dest);
    }
}

/**
 * Return the size of a file or a directory and its contents in bytes
 *
 * NOTE: This function may return unexpected results for files larger than
 *       2GB on 32bit hosts due to PHP's integer type being 32bit signed.
 *
 * @param string $path The path to the file/directory to calculate the size of
 * @return int
 */
function size_recursive($path)
{ 
    $size = 0;
    if (is_dir($path))
    {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

        foreach ($iterator as $file)
        {
            $size += $file->getSize();
        }
    }
    else
    {
        $size = filesize($path);
    }

    return $size;
}

/**
 * Read the last few lines of a file
 *
 * NOTE: Only works with files that have CRLF, LF or CR newlines
 *
 * @param string $file The path to the file to read from
 * @param int $lines The number of lines to return
 * @return string
 */
function tail($file, $lines)
{
    if ($lines < 1)
        return '';

    $line = '';
    $line_count = 0;
    $prev_char = '';
    $fp = fopen($file, 'r');
    $cursor = -1;

    fseek($fp, $cursor, SEEK_END);
    $char = fgetc($fp);

    while ($char !== false) {

        if ($char === "\n" || $char === "\r")
        {
            fseek($fp, --$cursor, SEEK_END);
            $next_char = fgetc($fp);

            if ($char === "\n" && $next_char === "\r")
            {
                $line_count++;
            }
            elseif ($char === "\r" && $prev_char !== "\n")
            {
                $line_count++;
            }
            elseif ($char === "\n")
            {
                $line_count++;
            }

            fseek($fp, ++$cursor, SEEK_END);
        }

        if ($line_count == $lines)
            break;

        $line = $char.$line;
        $prev_char = $char;
        fseek($fp, --$cursor, SEEK_END);
        $char = fgetc($fp);
    }

    fclose($fp);

    return $line;
}
}
?>