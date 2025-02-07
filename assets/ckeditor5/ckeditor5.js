import {
  ClassicEditor,
  Alignment,
  Autoformat,
  Autosave,
  BlockQuote,
  Bold,
  Essentials,
  GeneralHtmlSupport,
  Heading,
  HorizontalLine,
  ImageBlock,
  ImageToolbar,
  Indent,
  IndentBlock,
  Italic,
  Link,
  List,
  ListProperties,
  MediaEmbed,
  Paragraph,
  PasteFromOffice,
  Style,
  Table,
  TableCaption,
  TableCellProperties,
  TableColumnResize,
  TableProperties,
  TableToolbar,
  TextTransformation,
  TodoList,
  Underline,
} from "ckeditor5";
// Si vous devez importer des traductions, ici les traductions en français
import coreTranslations from "ckeditor5/translations/fr.js";
import "ckeditor5/dist/ckeditor5.min.css";
import("../styles/app.scss").then(() => {
    console.log("Styles CKEditor chargés !");
});


export default class EnhancedEditor extends ClassicEditor {}

EnhancedEditor.builtinPlugins = [
  Alignment,
  Autoformat,
  Autosave,
  BlockQuote,
  Bold,
  Essentials,
  GeneralHtmlSupport,
  Heading,
  HorizontalLine,
  ImageBlock,
  ImageToolbar,
  Indent,
  IndentBlock,
  Italic,
  Link,
  List,
  ListProperties,
  MediaEmbed,
  Paragraph,
  PasteFromOffice,
  Style,
  Table,
  TableCaption,
  TableCellProperties,
  TableColumnResize,
  TableProperties,
  TableToolbar,
  TextTransformation,
  TodoList,
  Underline,
];

EnhancedEditor.defaultConfig = {
  licenseKey: "GPL",
  toolbar: [
    "heading",
    "style",
    "|",
    "bold",
    "italic",
    "underline",
    "|",
    "horizontalLine",
    "link",
    "mediaEmbed",
    "insertTable",
    "blockQuote",
    "|",
    "alignment",
    "|",
    "bulletedList",
    "numberedList",
    "todoList",
    "outdent",
    "indent",
  ],
  image: {
    toolbar: ["imageTextAlternative", "imageStyle:block", "imageStyle:side"]
  },
  // Vous pouvez supprimer la ligne suivante si vous n'avez pas besoin de charger des traductions
  translations: [coreTranslations],
};
