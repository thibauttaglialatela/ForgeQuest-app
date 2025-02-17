// Adaptation du code CKEditor5 avec de nouvelles fonctionnalités
import {
  ClassicEditor,
  Alignment,
  Autosave,
  BlockQuote,
  Bold,
  Essentials,
  FontBackgroundColor,
  FontColor,
  FontFamily,
  FontSize,
  GeneralHtmlSupport,
  Heading,
  HorizontalLine,
  ImageBlock,
  ImageEditing,
  ImageToolbar,
  ImageUtils,
  Indent,
  IndentBlock,
  Italic,
  List,
  ListProperties,
  MediaEmbed,
  Paragraph,
  PasteFromOffice,
  RemoveFormat,
  Strikethrough,
  Style,
  Table,
  TableCaption,
  TableCellProperties,
  TableColumnResize,
  TableProperties,
  TableToolbar,
  TextTransformation,
  TodoList,
  Underline
} from "ckeditor5";

import translations from 'ckeditor5/translations/fr.js';
import 'ckeditor5/dist/ckeditor5.min.css';
import('../styles/app.scss').then(() => {
    console.log("Styles CKEditor chargés !");
});

export default class EnhancedEditor extends ClassicEditor {}

EnhancedEditor.builtinPlugins = [
  Alignment,
  Autosave,
  BlockQuote,
  Bold,
  Essentials,
  FontBackgroundColor,
  FontColor,
  FontFamily,
  FontSize,
  GeneralHtmlSupport,
  Heading,
  HorizontalLine,
  ImageBlock,
  ImageEditing,
  ImageToolbar,
  ImageUtils,
  Indent,
  IndentBlock,
  Italic,
  List,
  ListProperties,
  MediaEmbed,
  Paragraph,
  PasteFromOffice,
  RemoveFormat,
  Strikethrough,
  Style,
  Table,
  TableCaption,
  TableCellProperties,
  TableColumnResize,
  TableProperties,
  TableToolbar,
  TextTransformation,
  TodoList,
  Underline
];

EnhancedEditor.defaultConfig = {
  licenseKey: 'GPL',
  toolbar: [
    'heading', 'style', '|',
    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
    'bold', 'italic', 'underline', 'strikethrough', 'removeFormat', '|',
    'horizontalLine', 'mediaEmbed', 'insertTable', 'blockQuote', '|',
    'alignment', '|',
    'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
  ],
  fontFamily: {
    supportAllValues: true
  },
  fontSize: {
    options: [10, 12, 14, 'default', 18, 20, 22],
    supportAllValues: true
  },
  heading: {
    options: [
      { model: 'paragraph', title: 'Paragraphe', class: 'ck-heading_paragraph' },
      { model: 'heading1', view: 'h1', title: 'Titre 1', class: 'ck-heading_heading1' },
      { model: 'heading2', view: 'h2', title: 'Titre 2', class: 'ck-heading_heading2' },
      { model: 'heading3', view: 'h3', title: 'Titre 3', class: 'ck-heading_heading3' }
    ]
  },
  list: {
    properties: {
      styles: true,
      startIndex: true,
      reversed: true
    }
  },
  image: {
    toolbar: ['imageTextAlternative', 'imageStyle:block', 'imageStyle:side']
  },
  placeholder: 'Votre scénario commence ici ...',
  language: 'fr',
  translations: [translations]
};

