<?php
namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Photo\Photo;




class Page
{
    public static function page()
    {
?>
        Hello <?php echo $_SESSION['user']['first_name']; ?> <?php echo $_SESSION['user']['last_name']; ?>
        <?php  Photo::render() ?>
        <form action="/logout" method="post">
            <button type="submit">Logout puta</button>
        </form>
<?php
    }
}

Page::page();
