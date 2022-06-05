<?php
if ($_SERVER["REQUEST_URI"] == __FILE__)
  header('Location: '.ROOT_URL);

class TutorialModel extends Model
{
    public function index()
    {
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $this->query("SELECT t.title, t.content, t.id_Previous, t.id_Next,
                             CONCAT(p.id, ' - ',p.title) previous_title, 
                             CONCAT(n.id, ' - ',n.title) next_title
                      FROM tutorial AS t
                      LEFT OUTER JOIN tutorial AS p ON t.id_Previous = p.id
                      LEFT OUTER JOIN tutorial AS n ON t.id_Next = n.id
                      WHERE t.id = :id");
        $this->bind(':id', $get['id']);
        $rows = $this->single();
        $this->close();
        return $rows;
    }

    public function IsIdValid($ID)
    {
        $this->query("SELECT 1 Valid FROM tutorial WHERE id = :id");
        $this->bind(':id', $ID);
        $rows = $this->single();
        return ($rows['Valid'] == "1");
    }

}
?>