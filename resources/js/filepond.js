
import * as FilePond from 'filepond';
// Import the plugin code
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';



// Register the plugin
FilePond.registerPlugin(FilePondPluginImagePreview);

// Import the plugin code
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

// Register the plugin
FilePond.registerPlugin(FilePondPluginFileValidateType);



import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
FilePond.registerPlugin(FilePondPluginFileValidateSize);


window.FilePond = FilePond;