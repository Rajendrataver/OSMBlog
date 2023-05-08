<?php
include './classes/DBConnection.php';
class Blog extends DataBase
{
    function getBlog($condition)
    {
        if ($condition) {
            $sql = $this->connection->prepare("SELECT email,b.title,b.upload_date,b.author as aid,b.id,c.category as category,u.name as author,u.profile_image as author_image,b.short_note,b.teaser_image,b.banner_image,b.description from blogs as b left join users as u on b.author=u.id left join categories as c on b.category=c.id where b.$condition ORDER BY b.id DESC");
        } else {
            $sql = $this->connection->prepare("SELECT email,b.title,b.upload_date,b.author as aid, b.id,c.category as category,u.name as author,u.profile_image as author_image,b.short_note,b.teaser_image,b.banner_image,b.description from blogs as b left join users as u on b.author=u.id left join categories as c on b.category=c.id ORDER BY b.id DESC");
        }
        $sql->execute();
        return $sql;
    }
    function getCategory($condition)
    {
        if ($condition) {
            $sql = $this->connection->prepare("SELECT * from categories where $condition");
        } else
            $sql = $this->connection->prepare("SELECT * from categories");
        $sql->execute();
        return $sql;
    }
    function upload($title, $category, $short_note, $author, $teaser_image, $banner_image, $description)
    {
        $sql = $this->connection->prepare("SELECT id from categories where category='$category'");
        $sql->execute();
        if ($row = $sql->fetch()) {
            $category = $row['id'];
        } else {
            $sql = $this->connection->prepare("INSERT INTO categories (category) values(:category)");
            $sql->bindParam(':category', $category);
            $sql->execute();

            $sql = $this->connection->prepare("SELECT max(id) as id from categories");
            $sql->execute();

            $row = $sql->fetch();
            $category = $row['id'];

        }
        $date = date("Y-m-d");
        try {
            $sql = $this->connection->prepare("INSERT INTO blogs (title,category,short_note,teaser_image,banner_image,description,author,upload_date) values(:title,:category,:short_note,:teaser_image,:banner_image,:description,:author,:upload_date)");
            $sql->bindParam(':title', $title);
            $sql->bindParam(':category', $category);
            $sql->bindParam(':short_note', $short_note);
            $sql->bindParam(':teaser_image', $teaser_image);
            $sql->bindParam(':banner_image', $banner_image);
            $sql->bindParam(':description', $description);
            $sql->bindParam(':author', $author);
            $sql->bindParam(':upload_date', $date);
            $res = $sql->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    function update($id, $title, $category, $short_note, $author, $teaser_image, $banner_image, $description)
    {
        $sql = $this->connection->prepare("SELECT id from categories where category='$category'");
        $sql->execute();
        if ($row = $sql->fetch()) {
            $category = $row['id'];
        } else {
            $sql = $this->connection->prepare("INSERT INTO categories (category) values(:category)");
            $sql->bindParam(':category', $category);
            $sql->execute();

            $sql = $this->connection->prepare("SELECT max(id) as id from categories");
            $sql->execute();

            $row = $sql->fetch();
            $category = $row['id'];

        }
        $date = date("Y-m-d");
        try {
            $sql = $this->connection->prepare("UPDATE blogs SET title='$title',category=$category,short_note='$short_note',author=$author,teaser_image='$teaser_image',banner_image='$banner_image',description=:description,upload_date=:upload_date where id=$id");
            $sql->bindParam(':description', $description);
            $sql->bindParam(':upload_date', $date);
            $res = $sql->execute();

            return $res;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    function delete($blog_id, $author_id)
    {

        $sql = $this->connection->prepare("SELECT * from blogs where author=$author_id and id=$blog_id");
        $sql->execute();
        if ($row = $sql->fetch()) {
            $sql = $this->connection->prepare("DELETE FROM blogs WHERE id=$blog_id");
            var_dump($sql);
            $sql->execute();
            return true;
        } else {
            return false;
        }
    }
}

?>