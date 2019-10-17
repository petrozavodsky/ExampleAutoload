<?php

namespace ExampleAutoload\Classes;

class Activate {


	private $space = false;
	private $file;
	private $path;
	public $baseName;

	public function __construct( $file, $dir, $space ) {
		$this->file     = $file;
		$this->space    = $space;
		$this->path     = plugin_dir_path( $this->file );
		$this->baseName = $this->space;

		$this->activate( $dir );
	}

	/**
	 * @param resource $dir
	 * @param bool $space
	 */
	public function activate( $dir, $space = false ) {
		$s = DIRECTORY_SEPARATOR;
		if ( ! $space ) {
			$space = $this->space;
		}

		$dir = realpath( plugin_dir_path( $this->file ) ) . "{$s}src{$s}{$space}{$s}{$dir}";
		if ( $dir != false && file_exists( $dir ) ) {
			$dir = opendir( $dir );
			while ( ( $currentFile = readdir( $dir ) ) !== false ) {
				if ( $currentFile == '.' or $currentFile == '..' ) {
					continue;
				}
				$Name = basename( $currentFile, ".php" );
				$className  = "\\{$space}\\AutoPop\\{$Name}";
				new $className();
			}
			closedir( $dir );
		}
	}

}
