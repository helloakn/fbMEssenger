<?php
namespace Deployer;

require 'recipe/common.php';

inventory('deployer/config/svr.yml');
host('translate.jual.vip');
set('default_stage', 'production');

task('deploy:upload', function() {
    $deployPath = get('deploy_path');
    //cd($deployPath);
    //run('touch haha.txt');
    $appFiles = [
        'hk.php',
        'config.php',
    ];
    foreach ($appFiles as $file)
    {
        upload($file, "{$deployPath}/{$file}");
    }
});

task('deploy:translate', [
    'deploy:upload',
]);
/*- - - - - - .::Installation::. - - - - - -*/
task('deploy:install', [
    'deploy:installComposer',
    'deploy:composerRequire',
    'deploy:uploadComposerJson',
    'deploy:composerUpdate'

]);

task('deploy:installComposer',function(){
    run ("php -r \"copy('https://getcomposer.org/installer', 'composer-setup.php');\"");
    run ("php -r \"if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;\"");
    run ("php composer-setup.php");
    run ("php -r \"unlink('composer-setup.php');\"");
});

task('deploy:composerRequire',function(){
    run ("composer require stichoza/google-translate-php");
});

task('deploy:uploadComposerJson',function(){
    $deployPath = get('deploy_path');
    $appFiles = [
        'composer.json',
    ];
    foreach ($appFiles as $file)
    {
        upload($file, "{$deployPath}/{$file}");
    }
});

task('deploy:composerUpdate',function(){
    run ("composer update");
});
/*- - - - - - - - - - - - - - -*/
task('deploy:starting', function() {
    writeln('<info>Deploying...</info>');
});
task('deploy:done', function() {
    writeln('<info>Deployment is done.</info>');
});

before('deploy:upload', 'deploy:starting');
after('deploy:upload', 'deploy:done');
