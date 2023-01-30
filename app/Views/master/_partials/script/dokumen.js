columnDefs: [
    {
        render: function(data,type,row) {
            return data + ` <span class="rounded badge bg-danger" style="
            display: inline-block;
            vertical-align: super;
        ">${row[13]}</span>`;
        },
        targets:7,
    },
    {
        render: function(data,type,row) {
            return data + ` <span class="rounded badge bg-danger" style="
            display: inline-block;
            vertical-align: super;
        ">${row[14]}</span>`;
        },
        targets:8,
    },
    {
        render: function(data,type,row) {
            if(data != '') {
                return data + ` <span class="rounded badge bg-danger" style="
                    display: inline-block;
                    vertical-align: super;
                    ">${row[15]}</span>`;
            }
            return ''
            // return data
        },
        targets:9,
    },
    { targets: [13, 14, 15], visible: false},
]