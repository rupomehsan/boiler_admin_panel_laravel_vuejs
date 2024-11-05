import IFileExporter from '../core/IFileExporter';
import BaseBuilder from '../core/BaseBuilder';
export default class CsvBuilder extends BaseBuilder implements IFileExporter {
    private _FileName;
    private _Delimeter;
    private _Columns;
    private _RowData;
    constructor(fileName: string);
    setColumns(columns: string[]): CsvBuilder;
    setDelimeter(delimeter: string): CsvBuilder;
    addRow(row: string[]): CsvBuilder;
    addRows(rows: string[][]): CsvBuilder;
    private escapeCell;
    private getRowData;
    exportFile(): void;
}
