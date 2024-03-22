const { parallel, series, src, dest, watch, task } = require("gulp");

// const babel     = require("gulp-babel");
const concat    = require("gulp-concat");
const clean     = require("gulp-clean");
const plumber   = require("gulp-plumber");
const uglify    = require("gulp-uglify");

const rollup = require('gulp-better-rollup');
const babel = require('rollup-plugin-babel');
const resolve = require('rollup-plugin-node-resolve');
const commonjs = require('rollup-plugin-commonjs');


const sass = require('gulp-sass')(require('sass'));

const srcDir = "./src";
const jsConfig = require(srcDir+"/config");

const tmpDir = "./tmp";
const destDirJS = "../views/js";
const destDirCSS = "../views/css";

// const hash = '-'+ new Date().getTime();
const hash = '';

function jsBuild(done) {
    const tasks = ('jsBuild',jsConfig.map((config) => {
        return (done) => {
            const files = (config.files || []).map((f) => {
                if (f[0] == "~") {
                    return `./node_modules/${f.slice(1, f.length)}.js`;
                } else {
                    return `${srcDir}/${f}.js`;
                }
            });
            if (files.length === 0) {
                done();
                return;
            }
            return src(files)
                .pipe(plumber())
                .pipe(rollup({ plugins: [babel(), resolve(), commonjs()], onwarn: function(warning, handler) {
                        // Skip certain warnings

                        // should intercept ... but doesn't in some rollup versions
                        if ( warning.code === 'THIS_IS_UNDEFINED' ) { return; }

                        // console.warn everything else
                        handler( warning );
                    } }, 'umd'))
                .pipe(concat(`${config.name}.js`))
                // .pipe(uglify())
                .pipe(dest(destDirJS));
        };
    }));

    return parallel(...tasks, (parallelDone) => {
        parallelDone();
        done();
    })();
}

function jsClean(done) {
    const tasks = ('jsClean', jsConfig.map((config) => {
        return (done) => {
            const files = [
                `${tmpDir}/*`,
            ];
            return src(files, {read: false})
                .pipe(clean({force: true}));
        };
    }));

    return parallel(...tasks, (parallelDone) => {
        parallelDone();
        done();
    })();
}

async function sassIt(done) {
    const tasks = ('sassIt', jsConfig.map((config) => {

        return (done) => {
            const files = (config.sassfiles || []).map((f) => `${srcDir}/${config.sassfiles}/index.scss`);
            if (files.length === 0) {
                done();
                return;
            }
            return src(files, { allowEmpty: true })
                .pipe(sass(done))
                .pipe(concat(`${config.name}${hash}.css`))
                .pipe(dest(destDirCSS)
                );
        };
    }));

    return parallel(...tasks, (parallelDone) => {
        parallelDone();
        done();
    })();
}


const runBuildJs = series(jsBuild);
const runBuildCss = series(sassIt);
const runClean = series(jsClean);

exports.build = runBuildJs;
exports.clean = runClean;
exports.default = function() {
    watch([srcDir+'/scss/*', srcDir+'/scss/*/*', srcDir+'/scss/*/*/*', srcDir+'/scss/*/*/*/*'], runBuildCss);
    watch([srcDir+'/components/**/*', srcDir+'/js/index.js'], series(runBuildJs));
};