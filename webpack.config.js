var Encore = require('@symfony/webpack-encore');

Encore
.setOutputPath('src/Resources/public/assets')
.addEntry('contao-datamaps-bundle', './src/Resources/assets/js/contao-datamaps-bundle.js')
.setPublicPath('/bundles/contaodatamaps/')
.setManifestKeyPrefix('bundles/contaodatamaps')
.disableSingleRuntimeChunk()
.splitEntryChunks()
// .configureSplitChunks(function(splitChunks) {
//     splitChunks.name =  function (module, chunks, cacheGroupKey) {
//         const moduleFileName = module.identifier().split('/').reduceRight(item => item).split('.').slice(0, -1).join('.');
//         return `${moduleFileName}`;
//     };
// })
.configureBabel(null)
.enableSourceMaps(!Encore.isProduction())
.enableSassLoader()
.enablePostCssLoader()
;

module.exports = Encore.getWebpackConfig();