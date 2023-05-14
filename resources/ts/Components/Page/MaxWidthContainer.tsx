import React, { PropsWithChildren } from 'react';
import { mc } from '@/Helpers/StringHelpers';

const MaxWidthContainer: React.FC<PropsWithChildren<{ className?: string }>> = ({ className, children }) => (
	<div className={mc(className, 'max-w-[95%] w-[1220px] m-auto')}>{children}</div>
);

export default MaxWidthContainer;
