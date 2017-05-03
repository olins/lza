<?php

use Phalcon\Mvc\Controller;
use Phalcon\Http\Request;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;

include_once dirname(dirname(__FILE__)).'/libraries/dom/simple_html_dom.php';

class IndexController extends Controller
{
    public function indexAction()
    {
        $news = new News();
        $activities = new Activities();
        $mission = new Mission();

        $latest_news = $news->find(    [
            "order" => "date",
            "limit" => 5,
        ]);

        $latest_activities = $activities->find(    [
            "order" => "date",
            "limit" => 5,
        ]);

        $mission_data = $mission->findFirst([
          "id" => 1,
        ]);

        $active = "index";

        $this->view->pick("index/index");
        $this->view->setVar("latest_news", $latest_news);
        $this->view->setVar("latest_activities", $latest_activities);
        $this->view->setVar("mission", $mission_data);
        $this->view->setVar("active", $active);

        $this->assets->addCss("css/index.css");
        $this->assets->addCss("css/main.css");
        $this->assets->addCss("css/monthly.css");
        $this->assets->addJs("js/jquery-3.1.1.js");
        $this->assets->addJs("js/jquery.js");

        $this->assets->addJs("js/mainMenu.js");
        $this->assets->addJs("js/monthly.js");
        $this->assets->addJs("js/calendar.js");
    }

    public function newsAction()
    {
      $currentPage = $this->request->getQuery("page", "int");
      $paginator = new PaginatorModel(
          [
              "data"  => News::find(),
              "limit" => 10,
              "page"  => $currentPage,
          ]
      );

      $page = $paginator->getPaginate();

      $active = "news";

      $this->view->pick("index/news");
      $this->view->setVar("page", $page);
      $this->view->setVar("active", $active);

      $this->assets->addCss("css/index.css");
      $this->assets->addCss("css/main.css");
      $this->assets->addJs("js/jquery-3.1.1.js");
      $this->assets->addJs("js/mainMenu.js");
    }

    public function newsArticleAction($news_id = null)
    {
      $active = "news";

      $news = News::findFirst(["id" => $news_id]);
      $this->view->pick("index/article");
      $this->view->setVar("active", $active);
      $this->view->setVar("news", $news);

      $this->assets->addCss("css/index.css");
      $this->assets->addCss("css/main.css");
      $this->assets->addJs("js/jquery-3.1.1.js");
      $this->assets->addJs("js/mainMenu.js");
    }

    public function activitiesArticleAction($activities_id = null)
    {
      $active = "activities";

      $activities = Activities::findFirst(["id" => $activities_id]);
      $this->view->pick("index/activities_article");
      $this->view->setVar("active", $active);
      $this->view->setVar("activities", $activities);

      $this->assets->addCss("css/index.css");
      $this->assets->addCss("css/main.css");
      $this->assets->addJs("js/jquery-3.1.1.js");
      $this->assets->addJs("js/mainMenu.js");
    }

    public function newUserAction()
    {
      $this->view->pick("index/newUser");
    }

    public function loginAction()
    {
      $active = "admin";
      $this->view->pick("index/login");
      $this->view->setVar("active", $active);

      $this->assets->addCss("css/index.css");
      $this->assets->addCss("css/main.css");
      $this->assets->addJs("js/jquery-3.1.1.js");
      $this->assets->addJs("js/mainMenu.js");
    }

    public function verifyLoginAction()
    {
      $email    = $this->request->getPost("email");
      $password = $this->request->getPost("password");

      $user = Users::findFirst(
          [
              "email"    => $email,
              "password" => sha1($password),
          ]
      );

      $active = "admin";
      $this->view->pick("index/login");
      $this->view->setVar("active", $active);

      $this->assets->addCss("css/index.css");
      $this->assets->addCss("css/main.css");
      $this->assets->addJs("js/jquery-3.1.1.js");
      $this->assets->addJs("js/mainMenu.js");
    }

    public function newArticleAction()
    {
      $active = "admin";
      $this->view->pick("index/newArticle");
      $this->view->setVar("active", $active);

      $this->assets->addCss("css/index.css");
      $this->assets->addCss("css/main.css");
      $this->assets->addJs("js/jquery-3.1.1.js");
      $this->assets->addJs("js/mainMenu.js");
      $this->assets->addJs("js/tinymce.min.js");
    }

    public function historyAction()
    {
      $active = "about";
      $this->view->pick("index/history");
      $this->view->setVar("active", $active);

      $this->assets->addCss("css/index.css");
      $this->assets->addCss("css/main.css");
      $this->assets->addJs("js/jquery-3.1.1.js");
      $this->assets->addJs("js/mainMenu.js");
      $this->assets->addJs("js/tinymce.min.js");
    }

    public function documentsAction()
    {
      $active = "about";
      $documents = new Documents();
      $document_list =  $documents->find();

      $this->view->pick("index/documents");
      $this->view->setVar("active", $active);
      $this->view->setVar("documents", $document_list);

      $this->assets->addCss("css/index.css");
      $this->assets->addCss("css/main.css");
      $this->assets->addJs("js/jquery-3.1.1.js");
      $this->assets->addJs("js/mainMenu.js");
      $this->assets->addJs("js/tinymce.min.js");
    }

    public function documentAction($document_id = null)
    {
      $active = "about";

      $document = Documents::findFirst(["id" => $document_id]);
      $this->view->pick("index/document");
      $this->view->setVar("active", $active);
      $this->view->setVar("document", $document);

      $this->assets->addCss("css/index.css");
      $this->assets->addCss("css/main.css");
      $this->assets->addJs("js/jquery-3.1.1.js");
      $this->assets->addJs("js/mainMenu.js");
    }

    public function ourHistoryAction()
    {
      $active = "about";

      $this->view->pick("index/history");
      $this->view->setVar("active", $active);

      $this->assets->addCss("css/index.css");
      $this->assets->addCss("css/main.css");
      $this->assets->addJs("js/jquery-3.1.1.js");
      $this->assets->addJs("js/mainMenu.js");
      $this->assets->addJs("js/tinymce.min.js");
    }

}
