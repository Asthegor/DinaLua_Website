<?php

class HomeModel extends Model
{
    public function Index()
    {
        $display = array(
            array(  'title' => 'Barre de navigation',
                    'dest'  => 'navbar',
                    'datas' => array($this->countNavItems(), $this->countVisibleNavItems(), $this->countNotVisibleNavItems())
            ),
            array(  'title' => 'Configurations',
                    'dest'  => 'configs',
                    'datas' => array($this->countConfigs(), 'N/A', 'N/A')
            ),
            array(  'title' => 'Nouvelles',
                    'dest'  => 'news',
                    'datas' => array($this->countNews(), $this->countVisibleNews(), $this->countNotVisibleNews())
            ),
            array(  'title' => 'Téléchargements',
                    'dest'  => 'downloads',
                    'datas' => array($this->countDownloads(), 'N/A', 'N/A')
            ),
            array(  'title' => 'Tutoriels',
                    'dest'  => 'tutorials',
                    'datas' => array($this->countTutorials(), $this->countVisibleTutorials(), $this->countNotVisibleTutorials())
            ),
            array(  'title' => 'Exemples',
                    'dest'  => 'examples',
                    'datas' => array($this->countExamples(), $this->countVisibleExamples(), $this->countNotVisibleExamples())
            ),
            array(  'title' => 'Outils',
                    'dest'  => 'tools',
                    'datas' => array($this->countTools(), 'N/A', 'N/A')
            )
        );

        return $display;
    }

    private function countVisibleNavItems() { return (int)$this->countNavItems(true); }
    private function countNotVisibleNavItems() { return (int)$this->countNavItems(false); }
    private function countNavItems($bVisible = null)
    {
        $query = 'SELECT count(id) nb FROM navbar ';
        if (!is_null($bVisible))
        {
            $query .= 'WHERE visible = '.(int)$bVisible;
        }
        $this->query($query);
        $rows = $this->single();
        $this->close();
        return $rows['nb'];
    }
    private function countConfigs()
    {
        $query = 'SELECT count(id) nb FROM configs';
        $this->query($query);
        $rows = $this->single();
        $this->close();
        return $rows['nb'];
    }
    private function countVisibleNews() { return (int)$this->countNews(true); }
    private function countNotVisibleNews() { return (int)$this->countNews(false); }
    private function countNews($bVisible = null)
    {
        $query = 'SELECT count(id) nb FROM news';
        if (!is_null($bVisible))
        {
            $query .= ' WHERE visible = '.(int)$bVisible;
        }
        $this->query($query);
        $rows = $this->single();
        $this->close();
        return $rows['nb'];
    }
    private function countVisibleTutorials() { return (int)$this->countTutorials(true); }
    private function countNotVisibleTutorials() { return (int)$this->countTutorials(false); }
    private function countTutorials($bVisible = null)
    {
        $query = 'SELECT count(id) nb FROM tutorial ';
        if (!is_null($bVisible))
        {
            $query .= ' WHERE visible = '.(int)$bVisible;
        }
        $this->query($query);
        $rows = $this->single();
        $this->close();
        return $rows['nb'];
    }
    private function countVisibleExamples() { return (int)$this->countExamples(true); }
    private function countNotVisibleExamples() { return (int)$this->countExamples(false); }
    private function countExamples($bVisible = null)
    {
        $query = 'SELECT count(id) nb FROM example';
        if (!is_null($bVisible))
        {
            $query .= ' WHERE visible = '.(int)$bVisible;
        }
        $this->query($query);
        $rows = $this->single();
        $this->close();
        return $rows['nb'];
    }
    private function countDownloads() { return (int)$this->countFiles("engine"); }
    private function countTools() { return (int)$this->countFiles("tools"); }
    private function countFiles($Path)
    {
        $files = array_reverse(glob("files/".$Path."/*.zip"));
        return count($files);
    }
}
?>