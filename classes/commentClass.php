<?php
include './commentClass.php';
class Comment extends DataBase
{
    function getComments($blog_id)
    {
        $sql = $this->connection->prepare("SELECT c.date as comment_date, c.comment as comment, c.id as comment_id, u.name as name, u.email as email, u.id as user_id,u.profile_image as user_image,c.blog_id as blog_id  from comments as c left join users as u on c.user_id=u.id where c.blog_id=$blog_id ORDER BY c.id DESC");
        $sql->execute();

        return $sql;
    }
    function addComment($comment, $user_id, $blog_id)
    {
        $date = date("Y-m-d");
        $sql = $this->connection->prepare("INSERT into comments (comment,user_id,blog_id,date) values(:comment,:user_id,:blog_id,:date)");
        $sql->bindParam(":comment", $comment);
        $sql->bindParam(":user_id", $user_id);
        $sql->bindParam(":blog_id", $blog_id);
        $sql->bindParam(":date", $date);
        $sql->execute();
    }
    function deleteComment($comment_id)
    {
        $sql = $this->connection->prepare("DELETE FROM comments WHERE id=$comment_id");
        $sql->execute();
    }
}

?>