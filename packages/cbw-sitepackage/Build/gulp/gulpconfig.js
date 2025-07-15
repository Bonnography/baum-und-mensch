module.exports = function () {
    const fs = require('fs');
    const argv = require('minimist')(process.argv.slice(2))
    ;

    entryFolder = "Build/";
    outputFolder = "Resources/Public/";

    const config = {
        source: {
            scssMain: entryFolder + 'scss/cbw_sitepackage.scss',
            scssSelection: [
                entryFolder + 'scss/cbw_sitepackage.scss',
                entryFolder + 'scss/cbw_sitepackage/**/*.scss'
            ],
            rteCss: entryFolder + 'scss/rte.scss',
            jsLibs: [
                entryFolder + 'js/libs/*.js',
                entryFolder + 'js/bootstrap/bootstrap.js',
            ],
            mainJS: entryFolder + 'js/cbw_sitepackage.js',
            jsFile: entryFolder + 'js/',
            formJs: entryFolder + 'js/Frontend/form.js',
            fonts: entryFolder + 'font/**/*.{eot,svg,ttf,woff,woff2}',
            images: [
                entryFolder + 'img/*.{png,jpg,jpeg,gif,svg,ico}',
                entryFolder + 'img/**/*.{png,jpg,jpeg,gif,svg,ico}'
                ],
            icons: entryFolder + 'img/icons/**/*.{ico,svg,png,ico}',
            ico: entryFolder + 'img/*.ico',
            fileicons: entryFolder + 'img/FileIcons/*',
            backendimg: entryFolder + 'img/backend/**/*.{png,jpg,jpeg,gif,svg,ico}',
            css: entryFolder + 'css/'
        },

        target: {
            css: outputFolder + 'css/',
            js: outputFolder + 'js/',
            formJs: outputFolder + 'JavaScript/FrontEnd/',
            images: outputFolder + 'images/',
            backendimages: outputFolder + 'images/backend/',
            icons: outputFolder+ 'images/icons/',
            fileicons: outputFolder + 'images/icons/FileIcons',
            fonts: outputFolder + 'fonts/',
            rteCss: outputFolder + 'css/Backend/'
        }
    };
    return config;
};