mkdir Build\AjComprobantes\Php\Web
xcopy SourceCode\AjFwkPhp Build\AjComprobantes\Php\Web /s
xcopy SourceCode\PhpWebSiteEs Build\AjComprobantes\Php\Web /s
AjGenesis.Console Project\Project.xml tasks\BuildProject.ajg  Project\Technologies\Php.xml tasks\BuildTechnology.ajg  tasks\BuildProg.ajg
