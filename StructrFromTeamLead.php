<?php
// https://github.com/thephpleague/flysystem
abstract class FileSystemAbstact {
  public function __construct($options) {
    $this->_options = $options;
  }
  abstract public function read($fn);
}

class LocalFileSystem extends FileSystemAbstact {
  public function read($fn) {
    /**
     * Here goes implementation
     */
    return file_get_contents($fn);
  }
}

class S3FileSystem extends FileSystemAbstact {
  public function read($fn) {
    /**
     * Here goes implementation
     */
    return s3read($this->_options['s3']['bucket'], $fn);
  }
}

// https://www.yiiframework.com/doc/guide/2.0/en/concept-components
class FilesystemAdapter extends Component {
  public function getAdapter() : FileSystemAbstact
  {
    if ($this->_config['fs_type'] === 's3') {
      return new S3FileSystem($this->config['fs']['s3']);
    } else {
      return new LocalFileSystem($this->config['fs']['local']);
    }
  }
}


// your code in controllers
/**
 * Сейчас
 */
$path = $_POST['FILES']['upload']['tmp_name'];
$local = get_local_fileclass();
$local->upload('/admin/uploads/.../file.pdf', file_get_contents($path));


/**
 * Должно быть
 */

$path = $_POST['FILES']['upload']['tmp_name'];
$fs_adapter = $app->filesystem->getAdapter();
$fs_adapter->write('/admin/uploads/.../file.pdf', file_get_contents($path));