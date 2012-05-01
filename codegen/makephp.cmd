mkdir Build\AjConsorSite\Php\Web
xcopy SourceCode\AjFwkPhp Build\AjConsorSite\Php\Web /s /y
xcopy SourceCode\PhpWebSiteEs Build\AjConsorSite\Php\Web /s /y
AjGenesis.Console Project\Project.xml tasks\BuildProject.ajg  Project\Technologies\Php.xml tasks\BuildTechnology.ajg  tasks\BuildProg.ajg
