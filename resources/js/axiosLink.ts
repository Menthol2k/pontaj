import axios from 'axios';

export default async function downloadFile(url: string, name: string): Promise<number | string> {
    try {
        const res = await axios.get(url, { responseType: 'arraybuffer' });

        const fileURL = window.URL.createObjectURL(new Blob([res.data]));
        const fileLink = document.createElement('a');
        fileLink.href = fileURL;
        fileLink.setAttribute('download', name);
        document.body.appendChild(fileLink);
        fileLink.click();
        document.body.removeChild(fileLink);

        return res.status;
    } catch (error) {
        return 'AxiosLink.ts error';
    }
}
