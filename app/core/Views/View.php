<?php
namespace Core\Views;

class View
{
    protected $layout;
    protected $contentBlocks = [];
    protected $sectionName = '';
    protected $params = [];
    protected $isString = false;

    public function __construct()
    {
    }

    public function setLayout($layout)
    {
      $baseDirectory = './app/views/' . str_replace('.', '/', $layout);
      $filePath = $baseDirectory . '.php';

      if (file_exists($filePath) && is_file($filePath)) {
        return $this->layout = $filePath;
      }

      $indexFilePath = $baseDirectory . '/index.php';

      if (file_exists($indexFilePath) && is_file($indexFilePath)) {
          return $this->layout = $indexFilePath;
      }
    }

    public function setParams($params)
    {
      $this->params = $params;
    }

    public function getSection($sectionName) {
      return $this->contentBlocks[$sectionName] ?? null;
    }
    
    public function existSection($sectionName) {
      if(array_key_exists($sectionName, $this->contentBlocks)) {
        return true;
      }

      return false;
    }

    public function section($sectionName, $content = null)
    {
        ob_start();
        $this->sectionName = $sectionName;
        $this->isString = ($content !== null);
        if ($content !== null) {
            echo $content;
            $this->endSection();
        }
    }

    public function endSection()
    {
        $sectionContent = ob_get_clean();
        $this->contentBlocks[$this->sectionName] = $sectionContent;
    }

    public function render()
    {
        extract($this->contentBlocks);
        include_once $this->layout;
    }
}
?>
