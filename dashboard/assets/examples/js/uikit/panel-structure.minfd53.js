/*!
 * Remark Material (http://getbootstrapadmin.com/remark)
 * Copyright 2017 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */

!function(global,factory){if("function"==typeof define&&define.amd)define("/uikit/panel-structure",["jquery","Site"],factory);else if("undefined"!=typeof exports)factory(require("jquery"),require("Site"));else{var mod={exports:{}};factory(global.jQuery,global.Site),global.uikitPanelStructure=mod.exports}}(this,function(_jquery,_Site){"use strict";var _jquery2=babelHelpers.interopRequireDefault(_jquery),Site=babelHelpers.interopRequireWildcard(_Site);(0,_jquery2.default)(document).ready(function($){Site.run()}),(0,_jquery2.default)("#exampleButtonRandom").on("click",function(e){e.preventDefault(),(0,_jquery2.default)('[data-plugin="progress"]').each(function(){var number=Math.round(100*Math.random(1))+"%";(0,_jquery2.default)(this).asProgress("go",number)})}),window.customRefreshCallback=function(done){var $panel=(0,_jquery2.default)(this);setTimeout(function(){done(),$panel.find(".panel-body").html("Lorem ipsum In nostrud Excepteur velit reprehenderit quis consequat veniam officia nisi labore in est.")},1e3)}});